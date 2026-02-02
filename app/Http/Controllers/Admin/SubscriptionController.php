<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{
    private $midtrans_server_key;
    private $midtrans_is_production;

    public function __construct()
    {
        $this->midtrans_server_key = config('services.midtrans.server_key');
        $this->midtrans_is_production = config('services.midtrans.is_production', false);
    }

    public function index()
    {
        $user = Auth::user();
        $isSuperAdmin = $user->role === 'superadmin';
        
        if ($isSuperAdmin) {
            $transactions = Transaction::with('school')->latest()->paginate(50);
            $school = null;
        } else {
            $school = $user->school;
            $transactions = Transaction::where('school_id', $school->id)->latest()->paginate(50);
        }
        
        $plans = [
            [
                'id' => '6_months',
                'name' => 'Paket 6 Bulan',
                'price' => 350000,
                'duration' => '6 Bulan',
                'links' => 10,
                'description' => 'Cocok untuk 1 semester ujian.'
            ],
            [
                'id' => '1_year',
                'name' => 'Paket 1 Tahun',
                'price' => 650000,
                'duration' => '1 Tahun',
                'links' => 20,
                'description' => 'Lebih hemat untuk 2 semester.'
            ],
            [
                'id' => 'lifetime',
                'name' => 'Paket Lifetime',
                'price' => 2500000,
                'duration' => 'Selamanya',
                'links' => 'Unlimited',
                'description' => 'Investasi sekali untuk selamanya.'
            ],
        ];

        return view('admin.subscription.index', compact('school', 'transactions', 'plans'));
    }

    public function success()
    {
        return view('admin.subscription.success');
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'plan' => 'required|in:6_months,1_year,lifetime'
        ]);

        $plans = [
            '6_months' => ['name' => 'Paket 6 Bulan', 'price' => 350000],
            '1_year' => ['name' => 'Paket 1 Tahun', 'price' => 650000],
            'lifetime' => ['name' => 'Paket Lifetime', 'price' => 2500000],
        ];

        $plan = $plans[$request->plan];
        $school = Auth::user()->school;
        $reference = 'SCH-' . strtoupper(Str::random(10));

        // Create transaction in DB
        $transaction = Transaction::create([
            'school_id' => $school->id,
            'reference' => $reference,
            'type' => $request->plan,
            'amount' => $plan['price'],
            'status' => 'pending',
        ]);

        // Midtrans Snap API Request
        $auth = base64_encode($this->midtrans_server_key . ':');
        $url = $this->midtrans_is_production 
            ? 'https://app.midtrans.com/snap/v1/transactions' 
            : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . $auth,
            ])->post($url, [
                'transaction_details' => [
                    'order_id' => $reference,
                    'gross_amount' => (int)$plan['price'],
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'item_details' => [
                    [
                        'id' => $request->plan,
                        'price' => (int)$plan['price'],
                        'quantity' => 1,
                        'name' => $plan['name'] . ' Schola CBT',
                    ]
                ],
            ]);

            if ($response->successful()) {
                $snapToken = $response->json()['token'];
                $transaction->update(['snap_token' => $snapToken]);
                return response()->json(['token' => $snapToken]);
            }

            return response()->json(['error' => 'Gagal menghubungi Midtrans: ' . $response->body()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function showInvoice(Transaction $transaction)
    {
        $user = Auth::user();
        
        // Authorization check: only school owner or superadmin
        if ($user->role !== 'superadmin' && $user->school->id !== $transaction->school_id) {
            abort(403, 'Unauthorized access to invoice.');
        }

        if ($transaction->status !== 'success') {
            return back()->with('error', 'Invoice hanya tersedia untuk transaksi yang sudah lunas.');
        }

        $transaction->load('school');
        
        return view('admin.subscription.invoice', compact('transaction'));
    }

    public function callback(Request $request)
    {
        $serverKey = $this->midtrans_server_key;
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashed == $request->signature_key) {
            $transaction = Transaction::where('reference', $request->order_id)->first();
            if ($transaction) {
                if ($request->transaction_status == 'capture' || $request->transaction_status == 'settlement') {
                    $transaction->update([
                        'status' => 'success',
                        'paid_at' => now(),
                        'midtrans_payload' => $request->all()
                    ]);

                    // Update School Subscription
                    $school = $transaction->school;
                    $type = $transaction->type; // 6_months, 1_year, lifetime
                    
                    if ($type == 'lifetime') {
                        $school->update([
                            'subscription_type' => 'lifetime',
                            'subscription_expires_at' => null,
                            'max_links' => 999999, // Unlimited
                        ]);
                    } else {
                        $months = $type == '6_months' ? 6 : 12;
                        $addLinks = $type == '6_months' ? 10 : 20;
                        
                        $currentExpiry = ($school->subscription_expires_at && $school->subscription_expires_at->isFuture()) 
                            ? $school->subscription_expires_at 
                            : now();
                        
                        // Cumulative logic: if not trial/expired, add to existing. Otherwise start fresh.
                        $newMaxLinks = ($school->subscription_type === 'trial' || !$school->subscription_expires_at || $school->subscription_expires_at->isPast())
                            ? $addLinks 
                            : $school->max_links + $addLinks;

                        $school->update([
                            'subscription_type' => $type, 
                            'subscription_expires_at' => $currentExpiry->addMonths($months),
                            'max_links' => $newMaxLinks,
                        ]);
                    }
                } elseif ($request->transaction_status == 'pending') {
                    $transaction->update(['status' => 'pending']);
                } else {
                    $transaction->update(['status' => 'failed']);
                }
            }
        }

        return response()->json(['status' => 'success'], 200);

    }

    public function destroyTransaction(Transaction $transaction)
    {
        if (Auth::user()->role !== 'superadmin') {
            return abort(403, 'Unauthorized action.');
        }

        $transaction->delete();

        return back()->with('success', 'Riwayat transaksi berhasil dihapus.');
    }
}

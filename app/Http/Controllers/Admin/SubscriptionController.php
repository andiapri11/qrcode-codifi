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
    private $xendit_api_key;
    private $xendit_callback_token;

    public function __construct()
    {
        $this->xendit_api_key = config('services.xendit.api_key');
        $this->xendit_callback_token = config('services.xendit.callback_token');
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
                'name' => 'Basic Semester',
                'price' => 200000,
                'duration' => 'Langganan 6 Bulan',
                'links' => 10,
                'description' => 'Solusi hemat untuk kelancaran satu kali periode Ujian Semester.',
                'features' => [
                    '10 Barcode Secure (Anti-Screenshot)',
                    'Custom Logo & Nama Sekolah',
                    'Dukungan Update Berkala',
                    'Akses ke Dashboard Admin',
                    'Support Teknis Standar'
                ]
            ],
            [
                'id' => '1_year',
                'name' => 'Basic Annual',
                'price' => 350000,
                'duration' => 'Langganan 1 Tahun',
                'links' => 20,
                'description' => 'Pilihan cerdas untuk manajemen ujian satu tahun ajaran penuh.',
                'features' => [
                    '20 Barcode Secure (Anti-Screenshot)',
                    'Custom Logo & Nama Sekolah',
                    'Statistik Hasil Ujian (Basic)',
                    'Dukungan Update Prioritas',
                    'Lebih Hemat dibanding 6 bln',
                    'Support Teknis Prioritas'
                ]
            ],
            [
                'id' => 'lifetime',
                'name' => 'Exclusive Pro (3Y)',
                'price' => 700000,
                'duration' => 'Sekali bayar untuk 3 tahun',
                'links' => 100,
                'description' => 'Investasi branding sekolah terbaik & jangka panjang untuk efisiensi maksimal.',
                'features' => [
                    '100 Barcode Secure (Anti-Screenshot)',
                    'Full Whitelabel (Tanpa Nama Schola)',
                    'Kustom Kode Sekolah (Sesuai Instansi)',
                    'Upload Custom Background App',
                    'Akses Dashboard Admin Premium',
                    'Dukungan Update 3 Tahun Penuh'
                ]
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
            '6_months' => ['name' => 'Basic Semester', 'price' => 200000],
            '1_year' => ['name' => 'Basic Annual', 'price' => 350000],
            'lifetime' => ['name' => 'Exclusive Pro (3Y)', 'price' => 700000],
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

        // Xendit Invoice API Request
        $auth = base64_encode($this->xendit_api_key . ':');
        $url = 'https://api.xendit.co/v2/invoices';

        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $auth,
            ])->post($url, [
                'external_id' => $reference,
                'amount' => (int)$plan['price'],
                'description' => 'Aktivasi Paket ' . $plan['name'] . ' - Schola Exambro',
                'invoice_duration' => 86400, // 24 hours
                'customer' => [
                    'given_names' => Auth::user()->name,
                    'email' => Auth::user()->email,
                ],
                'items' => [
                    [
                        'name' => $plan['name'],
                        'quantity' => 1,
                        'price' => (int)$plan['price'],
                    ]
                ],
                // Redirect back to our site after payment
                'success_redirect_url' => route('subscription.success'),
                'failure_redirect_url' => route('subscription.index'),
            ]);

            if ($response->successful()) {
                $invoice = $response->json();
                $transaction->update(['snap_token' => $invoice['invoice_url']]); // Re-using column for simplicity
                return response()->json([
                    'success' => true,
                    'redirect_url' => route('subscription.payment', $reference)
                ]);
            }

            return response()->json(['error' => 'Gagal menghubungi Xendit: ' . $response->body()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    public function paymentDetail($reference)
    {
        $transaction = Transaction::where('reference', $reference)->firstOrFail();
        $user = Auth::user();

        // Security: Only owner or superadmin can view
        if ($user->role !== 'superadmin' && $user->school->id !== $transaction->school_id) {
            abort(403);
        }

        // If already success, redirect to success page
        if ($transaction->status === 'success') {
            return redirect()->route('subscription.success');
        }

        // Define plans for UI
        $plans = [
             '6_months' => ['name' => 'Basic Semester', 'duration' => '6 Bulan'],
             '1_year' => ['name' => 'Basic Annual', 'duration' => '1 Tahun'],
             'lifetime' => ['name' => 'Exclusive Pro (3Y)', 'duration' => '3 Tahun'],
        ];
        
        $plan = $plans[$transaction->type] ?? ['name' => 'Premium Plan', 'duration' => '-'];

        return view('admin.subscription.payment', compact('transaction', 'plan'));
    }

    public function showInvoice(Transaction $transaction)
    {
        $user = Auth::user();
        
        // Authorization check
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
        $xenditCallbackToken = $this->xendit_callback_token;
        $callbackTokenHeader = $request->header('x-callback-token');

        if ($xenditCallbackToken && $callbackTokenHeader !== $xenditCallbackToken) {
            return response()->json(['status' => 'error', 'message' => 'Invalid Callback Token'], 403);
        }

        $external_id = $request->external_id;
        $status = $request->status; // PAID, SETTLED, etc.

        $transaction = Transaction::where('reference', $external_id)->first();
        
        if ($transaction) {
            if ($status == 'PAID' || $status == 'SETTLED') {
                // Prevent duplicate processing
                if ($transaction->status === 'success') {
                    return response()->json(['status' => 'success', 'message' => 'Already processed'], 200);
                }

                $transaction->update([
                    'status' => 'success',
                    'paid_at' => now(),
                    'midtrans_payload' => $request->all() // Re-using column for payload
                ]);

                // Update School Subscription
                $school = $transaction->school;
                $type = $transaction->type;
                
                if ($type == 'lifetime') {
                    $currentExpiry = ($school->subscription_expires_at && $school->subscription_expires_at->isFuture()) 
                        ? $school->subscription_expires_at 
                        : now();
                        
                    $school->update([
                        'subscription_type' => 'lifetime',
                        'subscription_expires_at' => $currentExpiry->addMonths(36),
                        'max_links' => 100, 
                    ]);
                } else {
                    $months = $type == '6_months' ? 6 : 12;
                    $addLinks = $type == '6_months' ? 10 : 20;
                    
                    $currentExpiry = ($school->subscription_expires_at && $school->subscription_expires_at->isFuture()) 
                        ? $school->subscription_expires_at 
                        : now();
                    
                    $newMaxLinks = ($school->subscription_type === 'trial' || !$school->subscription_expires_at || $school->subscription_expires_at->isPast())
                        ? $addLinks 
                        : $school->max_links + $addLinks;

                    $school->update([
                        'subscription_type' => $type, 
                        'subscription_expires_at' => $currentExpiry->addMonths($months),
                        'max_links' => $newMaxLinks,
                    ]);
                }
            } elseif ($status == 'EXPIRED') {
                $transaction->update(['status' => 'failed']);
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

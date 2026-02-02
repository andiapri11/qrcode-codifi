<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if ($user->role !== 'superadmin') {
            return redirect()->route('schools.edit', $user->school_id);
        }

        $query = School::query();
        $search = $request->input('q');
        $perPage = $request->input('per_page', 10);

        $query->withCount('examLinks')
              ->withSum(['transactions as total_revenue' => function($query) {
                  $query->where('status', 'success');
              }], 'amount');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $schools = $query->latest()->paginate($perPage)->withQueryString();

        return view('admin.schools.index', [
            'title' => 'Manajemen Sekolah',
            'schools' => $schools
        ]);
    }

    public function create()
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.schools.create', [
            'title' => 'Tambah Sekolah Baru'
        ]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            // School Data
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'is_active' => 'required|boolean',
            'subscription_type' => ['required', Rule::in(['year', 'lifetime', 'trial'])],
            'subscription_months' => 'required_if:subscription_type,year|nullable|integer|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Admin Account Data
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|string|email|max:255|unique:users,email',
            'admin_phone' => 'required|string|max:20',
            'admin_password' => ['required', 'string', 'min:8'],
        ]);

        return DB::transaction(function() use ($request) {
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $request->file('logo')->store('schools', 'public');
            }

            $expiresAt = null;
            $maxLinks = 20; // Default

            if ($request->subscription_type === '6_months') {
                $expiresAt = Carbon::now()->addMonths(6);
                $maxLinks = 10;
            } elseif ($request->subscription_type === '1_year') {
                $expiresAt = Carbon::now()->addMonths(12);
                $maxLinks = 20;
            } elseif ($request->subscription_type === 'year') {
                $expiresAt = Carbon::now()->addMonths((int)$request->subscription_months);
                $maxLinks = 20;
            } elseif ($request->subscription_type === 'trial') {
                $expiresAt = Carbon::now()->addDays(3);
                $maxLinks = 5; // Trial default
            } elseif ($request->subscription_type === 'lifetime') {
                $maxLinks = 999999;
            }

            // 1. Create School
            $school = School::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'slug' => Str::slug($request->name),
                'domain_whitelist' => 'docs.google.com, forms.gle', // Default fallback
                'api_key' => 'SK-' . strtoupper(Str::random(16)),
                'is_active' => $request->is_active,
                'subscription_type' => $request->subscription_type,
                'subscription_expires_at' => $expiresAt,
                'max_links' => $maxLinks,
                'logo' => $logoPath,
            ]);

            // 2. Create User (School Admin)
            User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'phone' => $request->admin_phone,
                'password' => Hash::make($request->admin_password),
                'role' => 'school_admin',
                'school_id' => $school->id,
            ]);

            return redirect()->route('schools.index')->with('success', 'Instansi dan Akun Administrator berhasil dibuat.');
        });
    }

    public function edit(School $school)
    {
        $user = Auth::user();
        if ($user->role !== 'superadmin' && $user->school_id !== $school->id) {
            abort(403);
        }

        return view('admin.schools.edit', [
            'title' => 'Edit Sekolah',
            'school' => $school
        ]);
    }

    public function update(Request $request, School $school)
    {
        $user = Auth::user();
        if ($user->role !== 'superadmin' && $user->school_id !== $school->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => $user->role === 'superadmin' ? 'required|boolean' : 'nullable',
            'subscription_type' => $user->role === 'superadmin' ? ['required', Rule::in(['year', '6_months', '1_year', 'lifetime', 'trial'])] : 'nullable',
            'subscription_months' => 'required_if:subscription_type,year|nullable|integer|min:0',
            'max_links' => $user->role === 'superadmin' ? 'nullable|integer|min:1' : 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'slug' => Str::slug($request->name),
        ];

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($school->logo) {
                Storage::disk('public')->delete($school->logo);
            }
            $data['logo'] = $request->file('logo')->store('schools', 'public');
        }

        if ($user->role === 'superadmin') {
            $data['is_active'] = $request->is_active;
            $data['subscription_type'] = $request->subscription_type;
            
            // Auto-calculate based on type if it's changed or specifically requested
            if ($request->subscription_type === '6_months') {
                $maxLinks = 10;
                $months = (int)($request->subscription_months ?: 6);
                $currentExpiry = ($school->subscription_expires_at && $school->subscription_expires_at->isFuture()) 
                    ? $school->subscription_expires_at 
                    : Carbon::now();
                
                $data['max_links'] = $school->subscription_type === '6_months' ? $school->max_links : $maxLinks;
                $data['subscription_expires_at'] = $currentExpiry->addMonths($months);
            } elseif ($request->subscription_type === '1_year') {
                $maxLinks = 20;
                $months = (int)($request->subscription_months ?: 12);
                $currentExpiry = ($school->subscription_expires_at && $school->subscription_expires_at->isFuture()) 
                    ? $school->subscription_expires_at 
                    : Carbon::now();
                
                $data['max_links'] = $school->subscription_type === '1_year' ? $school->max_links : $maxLinks;
                $data['subscription_expires_at'] = $currentExpiry->addMonths($months);
            } elseif ($request->subscription_type === 'year') {
                $months = (int)$request->subscription_months;
                $currentExpiry = ($school->subscription_expires_at && $school->subscription_expires_at->isFuture()) 
                    ? $school->subscription_expires_at 
                    : Carbon::now();
                $data['subscription_expires_at'] = $currentExpiry->addMonths($months);
                // Keep existing max_links or set default if not existing
                $data['max_links'] = $school->max_links ?: 20;
            } elseif ($request->subscription_type === 'trial') {
                $data['subscription_expires_at'] = Carbon::now()->addDays(3);
                $data['max_links'] = 5; // Reset to trial limit
            } elseif ($request->subscription_type === 'lifetime') {
                $data['subscription_expires_at'] = null;
                $data['max_links'] = 999999;
            }

            // Manual override for max_links if provided
            if ($request->filled('max_links')) {
                $data['max_links'] = $request->max_links;
            }
        }

        $school->update($data);

        if ($user->role === 'superadmin') {
            return redirect()->route('schools.index')->with('success', 'Data sekolah berhasil diperbarui.');
        }

        return redirect()->route('schools.edit', $school->id)->with('success', 'Profil instansi berhasil diperbarui.');
    }

    public function destroy(School $school)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        // Delete related data first to avoid foreign key constraints
        $school->users()->delete();
        $school->examLinks()->delete();

        if ($school->logo) {
            Storage::disk('public')->delete($school->logo);
        }

        $school->delete();
        return redirect()->route('schools.index')->with('success', 'Instansi berhasil dihapus beserta seluruh data terkait.');
    }

    public function toggleStatus(School $school)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $school->update([
            'is_active' => !$school->is_active
        ]);

        $status = $school->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Instansi {$school->name} berhasil {$status}.");
    }
}

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

class SchoolController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            $schools = School::withCount('examLinks')->latest()->get();
        } else {
            $schools = School::where('id', $user->school_id)->withCount('examLinks')->get();
        }

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
            'name' => 'required|string|max:255',
            'domain_whitelist' => 'required|string|max:255',
            'is_active' => 'required|boolean',
            'subscription_type' => ['required', Rule::in(['year', 'lifetime'])],
            'subscription_months' => 'required_if:subscription_type,year|nullable|integer|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('schools', 'public');
        }

        $expiresAt = null;
        if ($request->subscription_type === 'year') {
            $expiresAt = Carbon::now()->addMonths((int)$request->subscription_months);
        }

        School::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'domain_whitelist' => $request->domain_whitelist,
            'api_key' => Str::random(32),
            'is_active' => $request->is_active,
            'subscription_type' => $request->subscription_type,
            'subscription_expires_at' => $expiresAt,
            'logo' => $logoPath,
        ]);

        return redirect()->route('schools.index')->with('success', 'Sekolah berhasil ditambahkan.');
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
            'domain_whitelist' => 'required|string|max:255',
            'is_active' => $user->role === 'superadmin' ? 'required|boolean' : 'nullable',
            'subscription_type' => $user->role === 'superadmin' ? ['required', Rule::in(['year', 'lifetime'])] : 'nullable',
            'subscription_months' => 'required_if:subscription_type,year|nullable|integer|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'domain_whitelist' => $request->domain_whitelist,
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
            
            if ($request->subscription_type === 'year') {
                if ($request->filled('subscription_months')) {
                    $data['subscription_expires_at'] = Carbon::now()->addMonths((int)$request->subscription_months);
                }
            } else {
                $data['subscription_expires_at'] = null;
            }
        }

        $school->update($data);

        return redirect()->route('schools.index')->with('success', 'Data sekolah berhasil diperbarui.');
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
}

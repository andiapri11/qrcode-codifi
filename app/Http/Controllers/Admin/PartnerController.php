<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PartnerController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'Akses Terbatas.');
        }

        // Only School Admins (Partners)
        $users = User::where('role', 'school_admin')->with('school')->latest()->get();
        $schools = School::all();

        return view('admin.partners.index', [
            'title' => 'Manajemen Mitra Sekolah',
            'users' => $users,
            'schools' => $schools
        ]);
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'school_id' => ['required', 'exists:schools,id'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'school_admin',
            'school_id' => $request->school_id,
        ]);

        return back()->with('success', 'Admin Mitra berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', Rules\Password::defaults()],
            'school_id' => ['required', 'exists:schools,id'],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'school_id' => $request->school_id,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data Mitra berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403);
        }

        $user->delete();
        return back()->with('success', 'Akun Mitra berhasil dihapus.');
    }
}

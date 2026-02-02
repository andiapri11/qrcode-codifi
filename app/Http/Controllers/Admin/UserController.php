<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        if (auth()->user()->role !== 'superadmin') {
            abort(403, 'Akses Terbatas: Hanya Administrator Pusat yang dapat mengelola akun.');
        }

        // Only Internal Admins (Super Admins)
        $users = User::where('role', 'superadmin')->latest()->paginate(25);
        $schools = []; // No school selection needed for internal admin usually

        return view('admin.users.index', [
            'title' => 'Manajemen Admin Internal',
            'users' => $users,
            'schools' => $schools
        ]);
    }

    public function store(Request $request)
    {
        $currentUser = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
        ]);

        // Security check
        if ($currentUser->role !== 'superadmin') {
            abort(403);
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'superadmin',
            'school_id' => null,
        ]);

        return back()->with('success', 'Admin Internal berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $currentUser = auth()->user();

        // Admin cannot edit a Superadmin if they are not a Superadmin themselves
        if ($currentUser->role !== 'superadmin' && $user->role === 'superadmin') {
            abort(403);
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'password' => ['nullable', Rules\Password::defaults()],
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => 'superadmin',
            'school_id' => null,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return back()->with('success', 'Data administrator berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
        }

        if (auth()->user()->role !== 'superadmin' && $user->role === 'superadmin') {
             return back()->with('error', 'Unauthorized.');
        }

        $user->delete();
        return back()->with('success', 'Administrator berhasil dihapus.');
    }
}

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
        $currentUser = auth()->user();
        
        if ($currentUser->role === 'superadmin') {
            $users = User::with('school')->latest()->get();
            $schools = School::all();
        } else {
            $users = User::where('school_id', $currentUser->school_id)->latest()->get();
            $schools = School::where('id', $currentUser->school_id)->get();
        }

        return view('admin.users.index', [
            'title' => 'Manajemen Administrator',
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
            'role' => ['required', 'in:superadmin,school_admin'],
            'school_id' => ['required_if:role,school_admin', 'nullable', 'exists:schools,id'],
        ]);

        // Security check
        if ($currentUser->role !== 'superadmin' && $request->role === 'superadmin') {
            return back()->with('error', 'Unauthorized role assignment.');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'school_id' => $request->role === 'superadmin' ? null : ($request->school_id ?? $currentUser->school_id),
        ]);

        return back()->with('success', 'Administrator berhasil ditambahkan.');
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

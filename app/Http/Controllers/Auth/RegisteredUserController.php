<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::default()],
            'school_name' => ['required', 'string', 'max:255', 'unique:schools,name'],
        ]);

        return DB::transaction(function () use ($request) {
            // 1. Create the Institution (School) with 2-Day Trial Status
            $school = School::create([
                'name' => $request->school_name,
                'slug' => Str::slug($request->school_name),
                'domain_whitelist' => 'docs.google.com, forms.gle', // Default whitelist
                'api_key' => 'SK-' . strtoupper(Str::random(16)),
                'is_active' => true,
                'subscription_type' => 'trial',
                'subscription_expires_at' => now()->addDays(2), // 2 Days Trial
            ]);

            // 2. Create the User as School Admin
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'school_admin',
                'school_id' => $school->id,
            ]);

            event(new Registered($user));

            Auth::login($user);

            return redirect(route('dashboard', absolute: false));
        });
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Create a redirect method to google api.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Create a callback method to handle google response.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = User::where('google_id', $user->id)->first();

            if ($findUser) {
                // Update avatar if changed
                $findUser->update([
                    'avatar' => $user->avatar,
                ]);

                Auth::login($findUser);
                
                // If school is not set, redirect to onboarding
                if (!$findUser->school_id && $findUser->role !== 'superadmin') {
                    return redirect()->route('auth.onboarding');
                }

                return redirect()->intended('dashboard');
            } else {
                // Look for user by email if google_id is not set
                $existingUser = User::where('email', $user->email)->first();

                if ($existingUser) {
                    $existingUser->update([
                        'google_id' => $user->id,
                        'avatar' => $user->avatar,
                    ]);
                    Auth::login($existingUser);

                    if (!$existingUser->school_id && $existingUser->role !== 'superadmin') {
                        return redirect()->route('auth.onboarding');
                    }

                    return redirect()->intended('dashboard');
                } else {
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'avatar' => $user->avatar,
                        'password' => bcrypt(Str::random(16)) 
                    ]);

                    Auth::login($newUser);
                    return redirect()->route('auth.onboarding');
                }
            }
        } catch (Exception $e) {
            return redirect('login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
        }
    }

    /**
     * Show onboarding form.
     */
    public function onboarding()
    {
        $user = Auth::user();
        
        // Prevent if already has school
        if ($user->school_id || $user->role === 'superadmin') {
            return redirect()->route('dashboard');
        }

        return view('auth.onboarding');
    }

    /**
     * Complete onboarding.
     */
    public function completeOnboarding(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        // 1. Create School
        $school = School::create([
            'name' => $request->school_name,
            'slug' => \Illuminate\Support\Str::slug($request->school_name) . '-' . \Illuminate\Support\Str::random(5),
            'subscription_type' => 'trial',
            'subscription_expires_at' => now()->addDays(7),
            'is_active' => true,
        ]);

        // 2. Update User
        $user->update([
            'school_id' => $school->id,
            'role' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard')->with('status', 'Profil instansi berhasil dilengkapi!');
    }
}

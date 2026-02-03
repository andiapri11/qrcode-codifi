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
            $findUser = User::where('google_id', $user->id)->orWhere('email', $user->email)->first();

            if ($findUser) {
                // Update avatar if changed (and google_id if matched by email)
                $findUser->update([
                    'google_id' => $user->id,
                    'avatar' => $user->avatar,
                ]);

                Auth::login($findUser);
                
                // If school is not set, redirect to onboarding
                if (!$findUser->school_id && $findUser->role !== 'superadmin') {
                    return redirect()->route('auth.onboarding');
                }

                return redirect()->intended('dashboard');
            } else {
                // NEW USER: Do NOT create account yet. Store in session.
                session([
                    'google_onboarding_data' => [
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'avatar' => $user->avatar,
                    ]
                ]);
                
                return redirect()->route('auth.onboarding');
            }
        } catch (Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage());
            return redirect('login')->with('error', 'Gagal login: ' . $e->getMessage() . '. Pastikan redirect URL di Google Console sudah benar.');
        }
    }

    /**
     * Show onboarding form.
     */
    public function onboarding()
    {
        // Check if user is logged in OR has partial registration data
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->school_id || $user->role === 'superadmin') {
                return redirect()->route('dashboard');
            }
        } elseif (!session('google_onboarding_data')) {
            // No auth, no session data -> irrelevant access
            return redirect()->route('login');
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

        $user = null;

        // 1. Create School First
        $school = School::create([
            'name' => $request->school_name,
            'slug' => \Illuminate\Support\Str::slug($request->school_name) . '-' . \Illuminate\Support\Str::random(5),
            'domain_whitelist' => '*', 
            'api_key' => \Illuminate\Support\Str::random(32),
            'subscription_type' => 'trial',
            'subscription_expires_at' => now()->addDays(3), // Trial 3 days
            'is_active' => true,
        ]);

        if (Auth::check()) {
            // Existing user adding school (Old flow)
            $user = Auth::user();
            $user->update([
                'school_id' => $school->id,
                'role' => 'school_admin',
                'password' => Hash::make($request->password),
            ]);
        } else {
            // New User coming from Session
            $googleData = session('google_onboarding_data');
            
            if (!$googleData) {
                return redirect()->route('login')->with('error', 'Sesi pendaftaran berakhir.');
            }

            $user = User::create([
                'name' => $googleData['name'],
                'email' => $googleData['email'],
                'google_id' => $googleData['google_id'],
                'avatar' => $googleData['avatar'],
                'password' => Hash::make($request->password),
                'role' => 'school_admin',
                'school_id' => $school->id,
            ]);

            Auth::login($user);
            session()->forget('google_onboarding_data');
        }

        return redirect()->route('dashboard')->with('status', 'Profil instansi berhasil dilengkapi!');
    }
}

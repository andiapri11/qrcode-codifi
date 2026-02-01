<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;

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
                    return redirect()->intended('dashboard');
                } else {
                    // Optional: Create new user if not found
                    // For now, let's just redirect to login with error if registration via google is not desired
                    // return redirect()->route('login')->with('error', 'Akun tidak terdaftar. Silakan hubungi admin.');
                    
                    // IF we want to allow new registrations:
                    $newUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'avatar' => $user->avatar,
                        'password' => encrypt('my-google-account-123') // Default password
                    ]);

                    Auth::login($newUser);
                    return redirect()->intended('dashboard');
                }
            }
        } catch (Exception $e) {
            return redirect('login')->with('error', 'Gagal login dengan Google: ' . $e->getMessage());
        }
    }
}

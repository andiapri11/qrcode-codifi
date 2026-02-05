<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // 1. Jika belum login atau SuperAdmin, abaikan (bebas akses)
        if (!$user || strtolower($user->role) === 'superadmin') {
            return $next($request);
        }

        // 2. Ambil data sekolah
        $school = $user->school;

        // 3. Jika sekolah tidak aktif atau subscription habis
        if (!$school || !$school->is_active || !$school->isSubscriptionActive()) {
            
            // Izinkan hanyak akses baca (GET), blokir tulis (POST, PUT, DELETE, PATCH)
            if (!$request->isMethod('get')) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Masa aktif Instansi Anda sudah habis. Silakan perpanjang untuk dapat melakukan perubahan.'
                    ], 403);
                }

                return back()->with('error', 'Masa aktif Instansi Anda sudah habis. Silakan perpanjang untuk dapat melakukan perubahan data.');
            }
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ExamLink;
use App\Models\School;
use Illuminate\Http\Request;

class HandshakeController extends Controller
{
    /**
     * Verify QR Token and return Exam URL
     * Expected inputs from Android App: school_id, token, signature
     */
    public function verify(Request $request)
    {
        $schoolId = $request->input('school_id');
        $token = $request->input('token');
        $signature = $request->input('signature'); // the 8-char chunk from QR
        
        if (!$token) {
            return response()->json(['success' => false, 'message' => 'Token tidak ditemukan'], 400);
        }

        // 0. APP AUTHENTICATION (Anti-MOD & Anti-Browser)
        $userAgent = $request->header('User-Agent');
        $appKey = $request->header('X-Schola-Key');
        $timestamp = $request->header('X-Timestamp');
        
        // Perketat: Hanya terima dari App Schola resmi
        if (!str_contains($userAgent, 'ScholaSecureBrowser') || $appKey !== 'Schola-Secret-Hash-2024') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Silakan gunakan Aplikasi Schola CBT resmi (v5.1)'
            ], 401);
        }

        // Anti-Replay: Cek apakah request sudah basi (lebih dari 60 detik)
        if (!$timestamp || abs(time() - (int)$timestamp) > 60) {
            return response()->json([
                'success' => false,
                'message' => 'Koneksi tidak sinkron. Periksa waktu di HP Anda.'
            ], 403);
        }

        // 1. SECURITY HANDSHAKE (Signature Verification if provided)
        if ($schoolId && $signature) {
            $secretKey = config('app.key');
            $expectedSignature = hash_hmac('sha256', $schoolId . '|' . $token, $secretKey);
            $expectedSigPart = substr($expectedSignature, 0, 8);

            if ($signature !== $expectedSigPart) {
                return response()->json([
                    'success' => false,
                    'message' => 'QR Code tidak sah atau telah dimanipulasi'
                ], 403);
            }
        }

        // 2. DATABASE VERIFICATION
        $query = ExamLink::with('school')
            ->where('secure_token', $token)
            ->where('is_active', true);

        if ($schoolId) {
            $query->where('school_id', $schoolId);
        }

        $examLink = $query->first();

        if (!$examLink) {
            return response()->json([
                'success' => false,
                'message' => 'Data ujian tidak ditemukan atau link sudah kadaluarsa'
            ], 404);
        }

        // 3. INSTITUTION STATUS (Manual Suspend)
        if (!$examLink->school->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Akses Instansi sedang ditangguhkan oleh Pusat'
            ], 403);
        }

        // 4. SUBSCRIPTION STATUS
        if (!$examLink->school->isSubscriptionActive()) {
            return response()->json([
                'success' => false,
                'message' => 'Masa langganan Instansi ini telah berakhir. Silakan hubungi admin.'
            ], 402);
        }

        // Dynamically create whitelist from the exam URL domain
        $examDomain = parse_url($examLink->exam_url, PHP_URL_HOST);
        $baseWhitelist = ['docs.google.com', 'forms.gle', 'accounts.google.com', 'gstatic.com', 'googleusercontent.com', 'googleapis.com'];
        if ($examDomain) {
            array_unshift($baseWhitelist, $examDomain);
        }
        $whitelist = implode(', ', array_unique($baseWhitelist));

        // 5. INCREMENT SCAN COUNT
        $examLink->increment('scan_count');

        // 6. SUCCESS RESPOND
        return response()->json([
            'success' => true,
            'data' => [
                'school_id' => $examLink->school_id,
                'school_name' => $examLink->school->name,
                'exam_title' => $examLink->title,
                'exam_url' => $examLink->exam_url,
                'domain_whitelist' => $whitelist,
                'authorized_at' => now()->toIso8601String(),
            ]
        ]);
    }

    /**
     * Fetch School Info by School Code (for branding)
     */
    public function fetchBranding(Request $request)
    {
        $code = strtoupper($request->input('school_code'));

        if (!$code) {
            return response()->json(['success' => false, 'message' => 'Kode instansi wajib diisi'], 400);
        }

        // APP AUTHENTICATION (Strict matching with verify endpoint)
        $userAgent = $request->header('User-Agent');
        $appKey = $request->header('X-Schola-Key');
        $timestamp = $request->header('X-Timestamp');
        
        if (!str_contains($userAgent, 'ScholaSecureBrowser') || $appKey !== 'Schola-Secret-Hash-2024') {
            return response()->json([
                'success' => false,
                'message' => 'Akses ditolak. Gunakan aplikasi resmi.'
            ], 401);
        }

        try {
            // Cari berdasarkan school_code (5 char) atau numeric ID (untuk fallback)
            $school = School::where('school_code', $code)
                ->orWhere('id', $code)
                ->first();

            if (!$school) {
                return response()->json([
                    'success' => false,
                    'message' => 'Instansi tidak ditemukan'
                ], 404);
            }

            if (!$school->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Instansi sedang dinonaktifkan.'
                ], 403);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'name' => $school->name,
                    'logo' => $school->logo_url,
                    'school_id' => $school->id,
                    'school_code' => $school->school_code,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server Error: ' . $e->getMessage()
            ], 500);
        }
    }
}

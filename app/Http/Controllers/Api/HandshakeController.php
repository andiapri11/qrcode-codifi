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
        $whitelist = $examDomain ? $examDomain . ', docs.google.com, forms.gle' : 'docs.google.com, forms.gle';

        // 5. SUCCESS RESPOND
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
}

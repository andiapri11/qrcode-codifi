<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\ExamLink;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QrController extends Controller
{
    /**
     * Generate QR Code with Logo
     */
    public function generate(Request $request)
    {
        try {
            $token = $request->query('token');
            $schoolId = $request->query('school_id');

            if (!$token || !$schoolId) {
                return response('Missing parameters', 400);
            }

            $school = School::find($schoolId);
            if (!$school) {
                return response('School not found', 404);
            }
            
            $exists = ExamLink::where('secure_token', $token)
                              ->where('school_id', $schoolId)
                              ->exists();
            
            if (!$exists) {
                return response('Invalid token authorization', 403);
            }

            // Signed payload for security
            $secretKey = config('app.key');
            $signature = hash_hmac('sha256', $schoolId . '|' . $token, $secretKey);
            $encryptedPayload = "SCHOLA|{$schoolId}|{$token}|" . substr($signature, 0, 8);

            // LOGO PATH RESOLUTION
            $logoPath = null;
            if ($school->logo) {
                // If logo is already a full URL, we try to map it back to local storage
                if (Str::startsWith($school->logo, 'http')) {
                    $relativePath = str_replace(asset('storage/'), '', $school->logo);
                    if (Storage::disk('public')->exists($relativePath)) {
                        $logoPath = Storage::disk('public')->path($relativePath);
                    }
                } elseif (Storage::disk('public')->exists($school->logo)) {
                    $logoPath = Storage::disk('public')->path($school->logo);
                }
            }

            if (!$logoPath) {
                // Default logo fallbacks
                $paths = [
                    public_path('assets/images/logo.png'),
                    public_path('logo.png'),
                ];
                foreach ($paths as $path) {
                    if (file_exists($path)) {
                        $logoPath = $path;
                        break;
                    }
                }
            }

            // GENERATION
            // Generate QR base in SVG format
            $qrCode = QrCode::format('svg')
                ->size(600)
                ->errorCorrection('H')
                ->margin(1)
                ->generate($encryptedPayload);

            // Cast to string if it's an object
            $svg = (string)$qrCode;

            // If we have a logo, manually inject it into the SVG XML
            if ($logoPath && file_exists($logoPath)) {
                $binary = @file_get_contents($logoPath);
                if ($binary) {
                    $type = pathinfo($logoPath, PATHINFO_EXTENSION);
                    if ($type == 'jpg') $type = 'jpeg';
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($binary);
                    
                    // Logo size: 22% (132px)
                    $logoSize = 132;
                    $pos = (600 - $logoSize) / 2;
                    
                    // Construct the logo image tag. Use BOTH href and xlink:href for compatibility.
                    // We also add a white background rect under the logo to clear the QR bits.
                    $logoSvg = '<rect x="' . ($pos-5) . '" y="' . ($pos-5) . '" width="' . ($logoSize+10) . '" height="' . ($logoSize+10) . '" fill="white" rx="15" />';
                    $logoSvg .= '<image x="' . $pos . '" y="' . $pos . '" width="' . $logoSize . '" height="' . $logoSize . '" href="' . $base64 . '" xlink:href="' . $base64 . '" />';
                    
                    // Ensure the SVG tag has the xlink namespace
                    if (strpos($svg, 'xmlns:xlink') === false) {
                        $svg = str_replace('<svg ', '<svg xmlns:xlink="http://www.w3.org/1999/xlink" ', $svg);
                    }
                    
                    // Inject the logo before the closing </svg> tag
                    $svg = str_replace('</svg>', $logoSvg . '</svg>', $svg);
                }
            }

            return response($svg)
                ->header('Content-Type', 'image/svg+xml');

        } catch (\Exception $e) {
            \Log::error('QR Generation Error: ' . $e->getMessage());
            return response('Error: ' . $e->getMessage(), 500);
        }
    }
}

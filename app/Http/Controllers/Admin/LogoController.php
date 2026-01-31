<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LogoController extends Controller
{
    /**
     * Handle AJAX Logo Upload & Resize
     */
    public function upload(Request $request)
    {
        try {
            $request->validate([
                'school_id' => 'required|exists:schools,id',
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            ]);

            $school = School::findOrFail($request->school_id);
            $file = $request->file('logo');

            // 1. Process and Resize Image using GD
            $fileRealPath = $file->getRealPath();
            $info = getimagesize($fileRealPath);
            if (!$info) {
                throw new \Exception('Invalid image file');
            }

            $width = $info[0];
            $height = $info[1];
            $type = $info[2];

            // Create resource based on type
            switch ($type) {
                case IMAGETYPE_JPEG: 
                    $src = imagecreatefromjpeg($fileRealPath); 
                    $ext = '.jpg';
                    break;
                case IMAGETYPE_PNG:  
                    $src = imagecreatefrompng($fileRealPath);  
                    $ext = '.png';
                    break;
                default: 
                    throw new \Exception('Format gambar tidak didukung (Gunakan JPG/PNG)');
            }

            if (!$src) {
                throw new \Exception('Gagal membaca resource gambar');
            }

            // Target size: 400x400
            $targetWidth = 400;
            $targetHeight = 400;

            $dst = imagecreatetruecolor($targetWidth, $targetHeight);
            
            if ($type == IMAGETYPE_PNG) {
                imagealphablending($dst, false);
                imagesavealpha($dst, true);
                $transparent = imagecolorallocatealpha($dst, 255, 255, 255, 127);
                imagefilledrectangle($dst, 0, 0, $targetWidth, $targetHeight, $transparent);
            } else {
                $white = imagecolorallocate($dst, 255, 255, 255);
                imagefilledrectangle($dst, 0, 0, $targetWidth, $targetHeight, $white);
            }

            $side = min($width, $height);
            $x_offset = ($width - $side) / 2;
            $y_offset = ($height - $side) / 2;

            imagecopyresampled($dst, $src, 0, 0, $x_offset, $y_offset, $targetWidth, $targetHeight, $side, $side);

            ob_start();
            if ($type == IMAGETYPE_PNG) {
                imagepng($dst);
            } else {
                imagejpeg($dst, null, 85);
            }
            $imageData = ob_get_clean();

            imagedestroy($src);
            imagedestroy($dst);

            // 3. Store to disk
            $filename = 'schools/' . Str::random(40) . $ext;
            
            if ($school->logo) {
                Storage::disk('public')->delete($school->logo);
            }

            Storage::disk('public')->put($filename, $imageData);

            // 4. Update Database
            $school->logo = $filename;
            $school->save();

            return response()->json([
                'success' => true,
                'url' => asset('storage/' . $filename),
                'message' => 'Logo updated successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 422);
        }
    }
}

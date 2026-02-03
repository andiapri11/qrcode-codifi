<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class SchoolController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        if (strtolower($user->role) !== 'superadmin') {
            return redirect()->route('schools.edit', $user->school_id);
        }

        $query = School::query();
        $search = $request->input('q');
        $perPage = $request->input('per_page', 10);

        $query->withCount('examLinks')
              ->withSum(['transactions as total_revenue' => function($query) {
                  $query->where('status', 'success');
              }], 'amount');

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $schools = $query->latest()->paginate($perPage)->withQueryString();

        return view('admin.schools.index', [
            'title' => 'Manajemen Sekolah',
            'schools' => $schools
        ]);
    }

    public function create()
    {
        if (strtolower(Auth::user()->role) !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.schools.create', [
            'title' => 'Tambah Sekolah Baru'
        ]);
    }

    public function store(Request $request)
    {
        if (strtolower(Auth::user()->role) !== 'superadmin') {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            // School Data
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'is_active' => 'required|boolean',
            'subscription_type' => ['required', Rule::in(['year', 'lifetime', 'trial'])],
            'subscription_months' => 'required_if:subscription_type,year|nullable|integer|min:1',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            
            // Admin Account Data
            'admin_name' => 'required|string|max:255',
            'admin_email' => 'required|string|email|max:255|unique:users,email',
            'admin_phone' => 'required|string|max:20',
            'admin_password' => ['required', 'string', 'min:8'],
        ]);

        return DB::transaction(function() use ($request) {
            $logoPath = null;
            if ($request->hasFile('logo')) {
                $logoPath = $this->processLogo($request->file('logo'));
            }

            $expiresAt = null;
            $maxLinks = 20; // Default

            if ($request->subscription_type === '6_months') {
                $expiresAt = Carbon::now()->addMonths(6);
                $maxLinks = 10;
            } elseif ($request->subscription_type === '1_year') {
                $expiresAt = Carbon::now()->addMonths(12);
                $maxLinks = 20;
            } elseif ($request->subscription_type === 'year') {
                $expiresAt = Carbon::now()->addMonths((int)$request->subscription_months);
                $maxLinks = 20;
            } elseif ($request->subscription_type === 'trial') {
                $expiresAt = Carbon::now()->addDays(3);
                $maxLinks = 1; // Trial default
            } elseif ($request->subscription_type === 'lifetime') {
                $maxLinks = 999999;
            }

            // 1. Create School
            $school = School::create([
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'slug' => Str::slug($request->name),
                'domain_whitelist' => 'docs.google.com, forms.gle', // Default fallback
                'api_key' => 'SK-' . strtoupper(Str::random(16)),
                'is_active' => $request->is_active,
                'subscription_type' => $request->subscription_type,
                'subscription_expires_at' => $expiresAt,
                'max_links' => $maxLinks,
                'logo' => $logoPath,
                'exit_password' => $request->exit_password ?? 'admin123',
                'violation_password' => $request->violation_password ?? 'admin123',
            ]);

            // 2. Create User (School Admin)
            User::create([
                'name' => $request->admin_name,
                'email' => $request->admin_email,
                'phone' => $request->admin_phone,
                'password' => Hash::make($request->admin_password),
                'role' => 'school_admin',
                'school_id' => $school->id,
            ]);

            return redirect()->route('schools.index')->with('success', 'Instansi dan Akun Administrator berhasil dibuat.');
        });
    }

    public function edit(School $school)
    {
        $user = Auth::user();
        if (strtolower($user->role) !== 'superadmin' && $user->school_id !== $school->id) {
            abort(403);
        }

        return view('admin.schools.edit', [
            'title' => 'Edit Sekolah',
            'school' => $school
        ]);
    }

    public function update(Request $request, School $school)
    {
        $user = Auth::user();
        if (strtolower($user->role) !== 'superadmin' && $user->school_id !== $school->id) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => strtolower($user->role) === 'superadmin' ? 'required|boolean' : 'nullable',
            'subscription_type' => strtolower($user->role) === 'superadmin' ? ['required', Rule::in(['year', '6_months', '1_year', 'lifetime', 'trial'])] : 'nullable',
            'subscription_months' => 'required_if:subscription_type,year|nullable|integer|min:0',
            'max_links' => strtolower($user->role) === 'superadmin' ? 'nullable|integer|min:1' : 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'exit_password' => 'nullable|string|max:50',
            'violation_password' => 'nullable|string|max:50',
            'domain_whitelist' => 'nullable|string',
            'theme_color' => 'nullable|string|max:7',
            'custom_background' => 'nullable|image|mimes:jpeg,png,jpg|max:3072',
        ]);

        if (strtolower($user->role) === 'superadmin' || $school->subscription_type === 'lifetime') {
            $maxLength = $school->subscription_type === 'lifetime' ? 10 : 5;
            $request->validate([
                'school_code' => ['nullable', 'string', 'max:'.$maxLength, Rule::unique('schools', 'school_code')->ignore($school->id)],
            ]);
        }

        $data = [
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'slug' => Str::slug($request->name),
            'exit_password' => $request->exit_password,
            'violation_password' => $request->violation_password,
            'domain_whitelist' => $request->domain_whitelist,
            'theme_color' => $request->theme_color ?? '#3C50E0',
        ];

        if ((strtolower($user->role) === 'superadmin' || $school->subscription_type === 'lifetime') && $request->filled('school_code')) {
            $data['school_code'] = strtoupper($request->school_code);
        }

        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($school->logo) {
                Storage::disk('public')->delete($school->logo);
            }
            $data['logo'] = $this->processLogo($request->file('logo'));
        }

        if ($request->hasFile('custom_background') && (strtolower($user->role) === 'superadmin' || $school->subscription_type === 'lifetime')) {
            if ($school->custom_background) {
                Storage::disk('public')->delete($school->custom_background);
            }
            $data['custom_background'] = $this->processBackground($request->file('custom_background'));
        }

        if (strtolower($user->role) === 'superadmin') {
            $data['is_active'] = $request->is_active;
            $prevType = $school->subscription_type;
            $newType = $request->subscription_type;
            $data['subscription_type'] = $newType;

            // 1. Handle "Type Change" Defaults
            if ($newType !== $prevType) {
                if ($newType === 'trial') {
                    $data['subscription_expires_at'] = Carbon::now()->addDays(3);
                    $data['max_links'] = 1;
                } elseif ($newType === 'lifetime') {
                    $data['subscription_expires_at'] = null;
                    $data['max_links'] = 999999;
                } elseif ($newType === '6_months') {
                    $data['max_links'] = 10;
                } elseif ($newType === '1_year') {
                    $data['max_links'] = 20;
                }
            }

            // 2. Handle "Adding Time" (If subscription_months is filled)
            if ($request->filled('subscription_months') && (int)$request->subscription_months > 0) {
                $months = (int)$request->subscription_months;
                $currentExpiry = ($school->subscription_expires_at && $school->subscription_expires_at->isFuture()) 
                    ? $school->subscription_expires_at 
                    : Carbon::now();
                $data['subscription_expires_at'] = $currentExpiry->addMonths($months);
            } 
            // 3. Fallback Initial Expiry on Type Change to timed plan (if months not provided)
            elseif ($newType !== $prevType && ($newType === '6_months' || $newType === '1_year')) {
                 $defaultMonths = ($newType === '6_months') ? 6 : 12;
                 $data['subscription_expires_at'] = Carbon::now()->addMonths($defaultMonths);
            }

            // 4. Manual Overrides (if admin specifically wants a custom number)
            if ($request->filled('max_links')) {
                $data['max_links'] = $request->max_links;
            }
        }

        $school->update($data);

        if ($user->role === 'superadmin') {
            return redirect()->route('schools.index')->with('success', 'Data sekolah berhasil diperbarui.');
        }

        return redirect()->route('schools.edit', $school->id)->with('success', 'Profil instansi berhasil diperbarui.');
    }

    public function destroy(School $school)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        // Delete related data first to avoid foreign key constraints
        $school->users()->delete();
        $school->examLinks()->delete();

        if ($school->logo) {
            Storage::disk('public')->delete($school->logo);
        }

        $school->delete();
        return redirect()->route('schools.index')->with('success', 'Instansi berhasil dihapus beserta seluruh data terkait.');
    }

    public function toggleStatus(School $school)
    {
        if (Auth::user()->role !== 'superadmin') {
            abort(403);
        }

        $school->update([
            'is_active' => !$school->is_active
        ]);

        $status = $school->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->back()->with('success', "Instansi {$school->name} berhasil {$status}.");
    }

    private function processLogo($file)
    {
        try {
            if (!$file->isValid()) {
                return $file->store('schools', 'public');
            }

            $realPath = $file->getRealPath();
            $imageInfo = @getimagesize($realPath);
            
            if (!$imageInfo) {
                return $file->store('schools', 'public');
            }

            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $type = $imageInfo[2];
            $extension = $file->getClientOriginalExtension();
            
            $image = null;
            switch ($type) {
                case IMAGETYPE_JPEG:
                    $image = @imagecreatefromjpeg($realPath);
                    break;
                case IMAGETYPE_PNG:
                    $image = @imagecreatefrompng($realPath);
                    if ($image) {
                        imagepalettetotruecolor($image);
                        imagealphablending($image, true);
                        imagesavealpha($image, true);
                    }
                    break;
            }

            if (!$image) {
                return $file->store('schools', 'public');
            }

            // Resize (Max 800px)
            $maxSize = 800;
            if ($width > $maxSize || $height > $maxSize) {
                if ($width > $height) {
                    $newWidth = $maxSize;
                    $newHeight = (int)($height * ($maxSize / $width));
                } else {
                    $newHeight = $maxSize;
                    $newWidth = (int)($width * ($maxSize / $height));
                }

                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                
                if ($type == IMAGETYPE_PNG) {
                    imagealphablending($newImage, false);
                    imagesavealpha($newImage, true);
                    $transparent = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
                    imagefilledrectangle($newImage, 0, 0, $newWidth, $newHeight, $transparent);
                }
                
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($image);
                $image = $newImage;
            }

            $filename = Str::random(40) . '.' . $extension;
            $path = 'schools/' . $filename;

            ob_start();
            $success = false;
            
            if ($type == IMAGETYPE_PNG) {
                $success = @imagepng($image, null, 8); // PNG compression 0-9
            } else {
                $success = @imagejpeg($image, null, 85);
            }
            
            $binaryData = ob_get_clean();
            imagedestroy($image);

            if ($success && $binaryData) {
                Storage::disk('public')->put($path, $binaryData);
                return $path;
            }
        } catch (\Exception $e) {
            Log::error('Logo processing error: ' . $e->getMessage());
        }

        return $file->store('schools', 'public');
    }

    private function processBackground($file)
    {
        try {
            $realPath = $file->getRealPath();
            $imageInfo = @getimagesize($realPath);
            
            if (!$imageInfo) {
                return $file->store('backgrounds', 'public');
            }

            $width = $imageInfo[0];
            $height = $imageInfo[1];
            $type = $imageInfo[2];
            $extension = $file->getClientOriginalExtension();
            
            $image = null;
            if ($type == IMAGETYPE_JPEG) $image = @imagecreatefromjpeg($realPath);
            elseif ($type == IMAGETYPE_PNG) $image = @imagecreatefrompng($realPath);

            if (!$image) return $file->store('backgrounds', 'public');

            // Resize (Max 1200px for background)
            $maxSize = 1200;
            if ($width > $maxSize || $height > $maxSize) {
                if ($width > $height) {
                    $newWidth = $maxSize;
                    $newHeight = (int)($height * ($maxSize / $width));
                } else {
                    $newHeight = $maxSize;
                    $newWidth = (int)($width * ($maxSize / $height));
                }
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                imagedestroy($image);
                $image = $newImage;
            }

            $filename = Str::random(40) . '.' . $extension;
            $path = 'backgrounds/' . $filename;

            ob_start();
            if ($type == IMAGETYPE_PNG) imagepng($image, null, 8);
            else imagejpeg($image, null, 80);
            
            $binaryData = ob_get_clean();
            imagedestroy($image);

            if ($binaryData) {
                Storage::disk('public')->put($path, $binaryData);
                return $path;
            }
        } catch (\Exception $e) {
            Log::error('Background processing error: ' . $e->getMessage());
        }

        return $file->store('backgrounds', 'public');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\ExamLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $query = ExamLink::with('school')->latest();
        
        if ($user->role !== 'superadmin') {
            $query->where('school_id', $user->school_id);
            $schools = School::where('id', $user->school_id)->where('is_active', true)->get();
        } else {
            $schools = School::where('is_active', true)->get();
        }
        
        $links = $query->paginate(25);
        
        return view('admin.links.index', [
            'title' => 'Data Barcode Ujian',
            'links' => $links,
            'schools' => $schools
        ]);
    }

    public function create()
    {
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            $schools = School::where('is_active', true)->get();
        } else {
            $schools = School::where('id', $user->school_id)->where('is_active', true)->get();
        }

        return view('admin.links.create', [
            'title' => 'Generate QR Code',
            'schools' => $schools
        ]);
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'school_id' => 'required|exists:schools,id',
            'title' => 'required|string|max:255',
            'exam_url' => 'required|url',
        ]);

        if ($user->role !== 'superadmin' && $request->school_id != $user->school_id) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized school selection.'
            ], 403);
        }

        // Subscription & Quota Check
        $school = School::find($request->school_id);
        if (!$school->canCreateMoreLinks()) {
            $msg = $school->subscription_type === 'trial' 
                ? 'Akun Trial hanya diperbolehkan membuat maksimal 1 barcode.' 
                : 'Kuota barcode instansi Anda sudah penuh atau masa aktif telah habis.';
            
            return response()->json([
                'success' => false,
                'message' => $msg . ' Silakan perpanjang atau upgrade paket Anda.'
            ], 403);
        }

        // Generate a random 5-character alphanumeric token (uppercase)
        do {
            $token = Str::upper(Str::random(5));
        } while (ExamLink::where('secure_token', $token)->exists());

        $link = ExamLink::create([
            'school_id' => $request->school_id,
            'title' => $request->title,
            'exam_url' => $request->exam_url,
            'secure_token' => $token,
            'is_active' => true,
        ]);

        return response()->json([
            'success' => true,
            'token' => $token,
            'message' => 'QR Code berhasil dibuat!'
        ]);
    }

    public function destroy(ExamLink $link)
    {
        $user = Auth::user();
        
        if ($user->role !== 'superadmin' && $link->school_id !== $user->school_id) {
            abort(403);
        }
        
        $link->delete();
        return back()->with('success', 'Link ujian berhasil dihapus.');
    }

    public function bulkDelete(Request $request)
    {
        $user = Auth::user();
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return back()->with('error', 'Tidak ada item yang dipilih.');
        }

        $query = ExamLink::whereIn('id', $ids);
        
        // Ensure users can only delete their own school's links
        if ($user->role !== 'superadmin') {
            $query->where('school_id', $user->school_id);
        }

        $deletedCount = $query->delete();

        return back()->with('success', "$deletedCount link ujian berhasil dihapus secara massal.");
    }
}

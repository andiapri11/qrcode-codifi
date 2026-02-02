<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\ExamLink;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->role === 'superadmin') {
            $stats = [
                'total_schools' => School::count(),
                'total_links' => ExamLink::count(),
                'active_links' => ExamLink::where('is_active', true)->count(),
                'total_revenue' => \App\Models\Transaction::where('status', 'success')->sum('amount'),
            ];
            $latestSchools = School::withCount('examLinks')->latest()->take(5)->get();
            $latestTransactions = \App\Models\Transaction::with('school')->where('status', 'success')->latest()->take(5)->get();
        } else {
            $schoolId = $user->school_id;
            $stats = [
                'total_schools' => 1,
                'total_links' => ExamLink::where('school_id', $schoolId)->count(),
                'active_links' => ExamLink::where('school_id', $schoolId)->where('is_active', true)->count(),
            ];
            $latestSchools = School::where('id', $schoolId)->withCount('examLinks')->get();
            $latestTransactions = collect();
        }

        return view('admin.dashboard', [
            'title' => 'Dashboard Overview',
            'stats' => $stats,
            'latestSchools' => $latestSchools,
            'latestTransactions' => $latestTransactions
        ]);
    }
}

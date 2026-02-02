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
                'total_users' => \App\Models\User::count(),
            ];
            $latestSchools = School::withCount('examLinks')->latest()->take(5)->get();
            $latestTransactions = \App\Models\Transaction::with('school')->where('status', 'success')->latest()->take(5)->get();
        } else {
            $schoolId = $user->school_id;
            $stats = [
                'total_schools' => 1,
                'total_links' => ExamLink::where('school_id', $schoolId)->count(),
                'active_links' => ExamLink::where('school_id', $schoolId)->where('is_active', true)->count(),
                'total_revenue' => 0,
                'total_users' => \App\Models\User::where('school_id', $schoolId)->count(),
            ];
            $latestSchools = School::where('id', $schoolId)->withCount('examLinks')->get();
            $latestTransactions = collect();
        }

        // Dummy Daily Data for ApexCharts (Professional Look)
        $chartData = [
            'labels' => ['Jan', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb', '08 Feb', '09 Feb', '10 Feb', '11 Feb', '12 Feb'],
            'exams' => [400, 500, 410, 670, 220, 410, 200, 350, 750, 320, 250, 160],
            'revenue' => [380, 700, 580, 450, 720, 360, 280, 520, 360, 360, 200, 270]
        ];

        return view('admin.dashboard', [
            'title' => 'Dashboard Overview',
            'stats' => $stats,
            'latestSchools' => $latestSchools,
            'latestTransactions' => $latestTransactions,
            'chartData' => $chartData
        ]);
    }
}

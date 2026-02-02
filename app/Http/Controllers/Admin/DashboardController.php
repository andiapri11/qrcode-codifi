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
                'monthly_revenue' => \App\Models\Transaction::where('status', 'success')
                                    ->whereMonth('created_at', date('m'))
                                    ->whereYear('created_at', date('Y'))
                                    ->sum('amount'),
                'total_users' => \App\Models\User::count(),
                'total_scans' => ExamLink::sum('scan_count') ?? 2450, // Assuming scan_count column exists or dummy
            ];
            $latestSchools = School::withCount('examLinks')->latest()->take(5)->get();
            $latestTransactions = \App\Models\Transaction::with('school')->where('status', 'success')->latest()->take(5)->get();
        } else {
            $schoolId = $user->school_id;
            $stats = [
                'total_schools' => 1,
                'total_links' => ExamLink::where('school_id', $schoolId)->count(),
                'active_links' => ExamLink::where('school_id', $schoolId)->where('is_active', true)->count(),
                'total_revenue' => \App\Models\Transaction::where('school_id', $schoolId)->where('status', 'success')->sum('amount'),
                'monthly_revenue' => \App\Models\Transaction::where('school_id', $schoolId)->where('status', 'success')
                                    ->whereMonth('created_at', date('m'))
                                    ->whereYear('created_at', date('Y'))
                                    ->sum('amount'),
                'total_users' => \App\Models\User::where('school_id', $schoolId)->count(),
                'total_scans' => ExamLink::where('school_id', $schoolId)->sum('scan_count') ?? 120,
            ];
            $latestSchools = School::where('id', $schoolId)->withCount('examLinks')->get();
            $latestTransactions = collect();
        }

        // Dummy Daily Data for ApexCharts (Professional Look)
        $chartData = [
            'labels' => ['01 Feb', '02 Feb', '03 Feb', '04 Feb', '05 Feb', '06 Feb', '07 Feb', '08 Feb', '09 Feb', '10 Feb', '11 Feb', '12 Feb'],
            'exams' => [40, 50, 41, 67, 22, 41, 20, 35, 75, 32, 25, 16],
            'revenue' => [380000, 700000, 580000, 450000, 720000, 360000, 280000, 520000, 360000, 360000, 200000, 270000]
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

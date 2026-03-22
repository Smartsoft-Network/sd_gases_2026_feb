<?php

namespace App\Http\Controllers\Admin;

use App\Models\Visit;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TrafficController extends Controller
{
    public function index()
    {
        $totalVisits = Visit::count();
        $uniqueVisitors = Visit::distinct('ip')->count('ip');
        
        // Visits and Unique Visitors in the last 30 days
        $thirtyDaysAgo = Carbon::now()->subDays(30);
        $dailyData = Visit::where('created_at', '>=', $thirtyDaysAgo)
            ->select(
                DB::raw('DATE(created_at) as date'), 
                DB::raw('count(*) as total_visits'),
                DB::raw('count(distinct ip) as unique_visitors')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Visits and Unique Visitors All Time (grouped by Month)
        $allTimeData = Visit::select(
            DB::raw('DATE_FORMAT(created_at, "%Y-%m") as month'),
            DB::raw('count(*) as total_visits'),
            DB::raw('count(distinct ip) as unique_visitors')
        )
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top Pages
        $topPages = Visit::select('path', DB::raw('count(*) as count'))
            ->groupBy('path')
            ->orderBy('count', 'desc')
            ->limit(10)
            ->get();

        // Recent Visits
        $recentVisits = Visit::orderBy('created_at', 'desc')
            ->limit(20)
            ->get();

        return view('admin.traffic.index', compact(
            'totalVisits', 
            'uniqueVisitors', 
            'dailyData', 
            'allTimeData',
            'topPages', 
            'recentVisits'
        ));
    }
}

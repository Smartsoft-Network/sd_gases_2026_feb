<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $productCount = \App\Models\Product::count();
        $serviceCount = \App\Models\Service::count();
        $unreadMessageCount = \App\Models\Message::whereNull('replied_at')->count();
        $totalVisitCount = \App\Models\Visit::count();

        // Traffic for the last 7 days for a mini chart
        $sevenDaysAgo = \Carbon\Carbon::now()->subDays(7);
        $dailyTraffic = \App\Models\Visit::where('created_at', '>=', $sevenDaysAgo)
            ->select(
                \Illuminate\Support\Facades\DB::raw('DATE(created_at) as date'),
                \Illuminate\Support\Facades\DB::raw('count(*) as total_visits'),
                \Illuminate\Support\Facades\DB::raw('count(distinct ip) as unique_visitors')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $recentMessages = \App\Models\Message::orderBy('created_at', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact(
            'productCount',
            'serviceCount',
            'unreadMessageCount',
            'totalVisitCount',
            'dailyTraffic',
            'recentMessages'
        ));
    }

    public function updateUiSetting(Request $request)
    {
        $request->validate([
            'setting' => 'required|string',
            'value' => 'required',
        ]);

        session([$request->setting => $request->value]);

        return response()->json(['success' => true]);
    }
}

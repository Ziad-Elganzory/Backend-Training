<?php

namespace App\Http\Controllers;

use App\Services\DashboardStatsService;
use Illuminate\Http\Request;

class DashboardStatsController extends Controller
{
    public function __construct(private DashboardStatsService $dashboardStatsService){}
    public function index()
    {
        return response()->json($this->dashboardStatsService->getDashboardStats());
    }
    public function refresh(){
        $this->dashboardStatsService->resetDashboardStatsCache();
        return response()->json([
            'message' => "Dashboard stats cache cleared"
        ]);
    }
}

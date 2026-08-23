<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class DashboardStatsService
{
    public function getDashboardStats()
    {
        return Cache::remember('dashboard.stats.v1',30, function(){
            return Cache::lock("locks.dashboard.stats.v1",10)->block(5,function(){
                if($cached = Cache::get('dashboard.stats.v1')){
                    return $cached;
                }
                return [
                    'generated_at' => now()->toIso8601String(),
                    "orders_count" => 120,
                    "revenue" => 45000,
                    "currency" => "EGP"            
                ];
            });
        });
    }
    public function resetDashboardStatsCache()
    {
        Cache::forget("dashboard.stats.v1");
    }
}
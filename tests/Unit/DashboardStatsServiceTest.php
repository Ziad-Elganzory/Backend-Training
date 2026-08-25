<?php

use App\Services\DashboardStatsService;
use Illuminate\Support\Facades\Cache;

uses(Tests\TestCase::class);

beforeEach(function(){
    Cache::flush();
});

it('return dashboard stats with keys',function(){
    $service = new DashboardStatsService();

    $result = $service->getDashboardStats();

    expect($result)
        ->toHaveKeys(['generated_at','orders_count','revenue','currency'])
        ->and($result)->not->toBeNull();
});

it('stores dashboard stats in cache',function(){
    $service = new DashboardStatsService();

    $service->getDashboardStats();

    expect(Cache::has('dashboard.stats.v1'))->toBeTrue();
});

it('cache hit when dashboard stats is cached',function(){
    $this->travelTo(now());
    $service = new DashboardStatsService();

    $first = $service->getDashboardStats();

    $this->travel(20)->seconds();

    $second = $service->getDashboardStats();

    expect($first['generated_at'])->toBe($second['generated_at']);
});

it('rebuilds after cache forget',function(){
    $this->travelTo(now());
    $service = new DashboardStatsService();

    $first = $service->getDashboardStats();

    $service->resetDashboardStatsCache();
    expect(Cache::has('dashboard.stats.v1'))->toBeFalse();
    $this->travel(1)->second();

    $second = $service->getDashboardStats();
    expect(Cache::has('dashboard.stats.v1'))->toBeTrue();

    expect($first['generated_at'])->not->toBe($second['generated_at']);
});

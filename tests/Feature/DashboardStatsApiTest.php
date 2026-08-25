<?php

use Illuminate\Support\Facades\Cache;

beforeEach(function(){
    Cache::flush();
});

// Mini Project
it('returns the dashboard stats',function(){
    $this->getJson('/api/dashboard/stats')
        ->assertSuccessful()
        ->assertJsonStructure(['generated_at','orders_count','revenue','currency'])
        ->assertJsonPath('currency','EGP');
});

it('returns the same generated_at on consecutive requests',function(){
    $this->travelTo(now());

    $first = $this->getJson('/api/dashboard/stats')
        ->assertSuccessful()
        ->json('generated_at');

    $this->travel(20)->second();

    $second = $this->getJson('/api/dashboard/stats')
        ->assertSuccessful()
        ->json('generated_at');
    
    expect($second)->toBe($first);
});

it('clears the dashboard stats cache on refresh',function(){
    $this->travelTo(now());

    $first = $this->getJson('/api/dashboard/stats')
        ->assertSuccessful()
        ->json('generated_at');

    $this->postJson('/api/dashboard/stats/refresh')
        ->assertSuccessful()
        ->assertJson(["message" => "Dashboard stats cache cleared"]);

    $this->travel(1)->second();

    $second = $this->getJson('/api/dashboard/stats')
        ->assertSuccessful()
        ->json('generated_at');
    
    expect($second)->not->toBe($first);
});
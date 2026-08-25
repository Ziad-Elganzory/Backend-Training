<?php

use Illuminate\Support\Facades\Cache;

beforeEach(function(){
    Cache::flush();
});

// Mini Practice
it('returns the product catalog',function(){
    $this->getJson('/api/dashboard/stats')
        ->assertSuccessful()
        ->assertJsonStructure(['generated_at','orders_count','revenue','currency'])
        ->assertJsonPath('currency','EGP');
});

it('return the same generated_at on consecutive requests',function(){
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

it('clears the catalog cache on refresh',function(){
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
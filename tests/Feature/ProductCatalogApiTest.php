<?php

use Illuminate\Support\Facades\Cache;

beforeEach(function(){
    Cache::flush();
});

// Mini Practice
it('returns the product catalog',function(){
    $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->assertJsonStructure(['generated_at','products'])
        ->assertJsonPath('products.0.name','Keyboard');
});

it('return the same generated_at on consecutive requests',function(){
    $this->travelTo(now());

    $first = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');

    $this->travel(30)->second();

    $second = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');
    
    expect($second)->toBe($first);
});

it('clears the catalog cache on refresh',function(){
    $this->travelTo(now());

    $first = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');

    $this->postJson('/api/products/catalog/refresh')
        ->assertSuccessful()
        ->assertJson(["message" => "Products Catalog Refreshed Successfully"]);

    $this->travel(1)->second();

    $second = $this->getJson('/api/products/catalog')
        ->assertSuccessful()
        ->json('generated_at');
    
    expect($second)->not->toBe($first);
});
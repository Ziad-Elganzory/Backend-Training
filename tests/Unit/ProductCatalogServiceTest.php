<?php

use App\Services\ProductCatalogService;
use Illuminate\Support\Facades\Cache;

use function Illuminate\Support\seconds;

uses(Tests\TestCase::class);

beforeEach(function(){
    Cache::flush();
});

it('it returns products with generated_at',function(){
    $service = new ProductCatalogService();

    $result = $service->getProducts();

    expect($result)
        ->toHaveKeys(['generated_at','products'])
        ->and($result['products'])->toHaveCount(2)
        ->and($result['products'][0])->toHaveKeys(['id','name','price']);
});

it('it stores the catalog in cache',function(){
    $service = new ProductCatalogService();

    $service->getProducts();

    expect(Cache::has('products.catalog.v1'))->toBeTrue();
});

it('it returns the same generated_at on a cache hit',function(){
    $this->travelTo(now());
    $service = new ProductCatalogService();

    $first = $service->getProducts();

    $this->travel(30)->seconds();

    $second = $service->getProducts();

    expect($first['generated_at'])->toBe($second['generated_at']);
});

it('it rebuilds the catalog after forget',function(){
    $this->travelTo(now());
    $service = new ProductCatalogService();

    $first = $service->getProducts();
    $service->refreshProductsCatalogCache();

    $this->travel(30)->seconds();
    $second = $service->getProducts();

    expect($first['generated_at'])->not->toBe($second['generated_at']);

});
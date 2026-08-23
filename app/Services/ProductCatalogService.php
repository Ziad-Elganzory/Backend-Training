<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ProductCatalogService
{
    private array $products = [
        [
            "id" => 1,
            "name" => "Keyboard",
            "price" => 1500
        ],
        [
            "id" => 2,
            "name" => "Mouse",
            "price" => 400
        ]
    ];
    public function getProducts()
    {
        return Cache::remember('products.catalog.v1', 60, function () {
            Log::info('Fetching Products');
            return [
                'generated_at' => now()->toIso8601String(),
                'products' => $this->products,
            ];
        });
    }
}
<?php

namespace App\Support;

class ProductSearch
{
    /**
     * 
     * @param array{name: ?string, min_price: ?float, max_price: ?float, category: ?string} $filters
     */
    public function __construct(
        public array $filters,
        public string $sort,
        public int $limit
    ){}
}
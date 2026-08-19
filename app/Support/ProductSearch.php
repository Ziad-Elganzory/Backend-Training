<?php

namespace App\Support;

class ProductSearch
{
    /**
     * 
     * @param list<array{name: ?string, minPrice: ?float, maxPrice: ?float, category: ?string}> $filters
     */
    public function __construct(
        public array $filters,
        public string $sort,
        public int $limit
    ){}
}
<?php

namespace App\Builders;

use App\Support\ProductSearch;

class ProductSearchBuilder
{
    private ?string $name = null;
    private ?float $minPrice = null;
    private ?float $maxPrice = null;
    private ?string $category = null;
    private string $sort = 'name_asc';
    private int $limit = 15;

    public function named(string $name){
        $this->name = $name;
        return $this;
    }
    public function minPrice(float $price){
        $this->minPrice = $price;
        return $this;
    }
    public function maxPrice(float $price){
        $this->maxPrice = $price;
        return $this;
    }
    public function category(string $category){
        $this->category = $category;
        return $this;
    }
    public function sortBy(string $sort){
        $this->sort = $sort;
        return $this;
    }
    public function limit(int $limit){
        $this->limit = $limit;
        return $this;
    }
    public function build():ProductSearch
    {
        if($this->minPrice > $this->maxPrice){
            throw new \Exception("min price can't exceed max price");
        }

        $filters = [];

        if($this->name !== null){
            $filters["name"] = $this->name;
        }

        if($this->minPrice !== null){
            $filters["min_price"] = $this->minPrice;
        }

        if($this->maxPrice !== null){
            $filters["max_price"] = $this->maxPrice;
        }

        if($this->category !== null){
            $filters["category"] = $this->category;
        }

        return new ProductSearch(
            filters: $filters,
            sort: $this->sort,
            limit: $this->limit
        );
    }
}
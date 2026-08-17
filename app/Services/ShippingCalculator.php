<?php

namespace App\Services;

use App\Contracts\ShippingCostStrategyInterface;
use App\Factories\ShippingStrategyFactory;

class ShippingCalculator
{
    public function __construct(
        private ShippingStrategyFactory $factory
    )
    {}

    public function calculate(float $weight, float $orderTotal, string $strategy)
    {
        return $this->factory->make($strategy)->calculate($weight,$orderTotal);
        
    }
}
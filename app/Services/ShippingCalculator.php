<?php

namespace App\Services;

use App\Contracts\ShippingCostStrategyInterface;
use App\Factories\ShippingStrategyFactory;

class ShippingCalculator
{
    public function calculate(float $weight, float $orderTotal, ShippingCostStrategyInterface $strategy)
    {
        return $strategy->calculate($weight,$orderTotal);   
    }
}
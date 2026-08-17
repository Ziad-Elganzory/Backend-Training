<?php

namespace App\Strategies\Shipping;

use App\Contracts\ShippingCostStrategyInterface;
use Override;

class WeightBasedShippingStrategy implements ShippingCostStrategyInterface
{
    #[Override]
    public function calculate(float $weight, float $orderTotal): float
    {
        return $weight * 15;
    }
}
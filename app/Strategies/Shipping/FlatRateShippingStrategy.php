<?php

namespace App\Strategies\Shipping;

use App\Contracts\ShippingCostStrategyInterface;
use Override;

class FlatRateShippingStrategy implements ShippingCostStrategyInterface
{
    #[Override]
    public function calculate(float $weight, float $orderTotal): float
    {
        return 50;
    }
}
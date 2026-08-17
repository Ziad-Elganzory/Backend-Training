<?php

namespace App\Strategies\Shipping;

use App\Contracts\ShippingCostStrategyInterface;
use Override;

class FreeShippingStrategy implements ShippingCostStrategyInterface
{
    #[Override]
    public function calculate(float $weight, float $orderTotal): float
    {
        return 0;
    }
}
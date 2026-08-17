<?php
namespace App\Contracts;
interface ShippingCostStrategyInterface
{
    public function calculate(float $weight, float $orderTotal): float;
}
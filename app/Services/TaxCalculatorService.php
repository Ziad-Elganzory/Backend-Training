<?php

namespace App\Services;

class TaxCalculatorService
{
    public function calculate(float $amount): float
    {
        return $amount * 0.14;
    }
}
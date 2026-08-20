<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function charge(string $customerId, float $amount)
    {
        Log::info("Customer {$customerId} paid {$amount}$");
        return "pay_123";
    }
}
<?php

namespace App\Services;

use App\Contracts\Contracts\PaymentGateway;

class CheckoutService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected PaymentGateway $payment
    ){}

    public function pay(int $amount)
    {
        return $this->payment->charge($amount * 1000);
    }
}

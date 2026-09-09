<?php

namespace App\Services\Payment;

use App\Contracts\Contracts\PaymentGateway;
use Override;

class FakePaymentGateway implements PaymentGateway
{
    #[Override]
    public function charge(int $amountInCents): string
    {
        return "{$amountInCents} is fake charged successfully";
    }
}

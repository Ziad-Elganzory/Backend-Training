<?php

namespace App\Adapters;

use App\Clients\StripeClient;
use App\Contracts\PaymentGateway;
use Override;

class StripePaymentAdapter implements PaymentGateway
{
    public function __construct(
        private StripeClient $stripe
    ){}
    #[Override]
    public function charge(string $customerId, float $amount, string $currency): array
    {
        $amountInCents = $amount * 100;
        $result = $this->stripe->createCharge([
            $customerId,
            $amountInCents,
            $currency
        ]);
        return [
            "payment_id" => $result['id'],
            "status" => $result['paid'] ? "succeeded" : "Failed"
        ];
    }
}
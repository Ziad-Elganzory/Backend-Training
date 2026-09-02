<?php

namespace App\Adapters;

use App\Clients\PaymobClient;
use App\Clients\StripeClient;
use App\Contracts\PaymentGateway;
use Override;

class PaymobPaymentAdapter implements PaymentGateway
{
    public function __construct(
        private PaymobClient $paymob,
        private string $merchantRef
    ){}
    #[Override]
    public function charge(string $customerId, float $amount, string $currency): array
    {
        $amountInCents = $amount * 100;
        $result = $this->paymob->pay($amountInCents,$this->merchantRef,$currency);
        return [
            "payment_id" => $result["transaction_id"],
            "status" => $result['success'] ? "succeeded" : "Failed"
        ];
    }
}
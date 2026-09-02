<?php

namespace App\Clients;

class PaymobClient
{
    public function pay(float $amount, string $merchantRef, string $currency): array
    {
        return [
            "transaction_id" => "1",
            "success" => true
        ];
    }
}
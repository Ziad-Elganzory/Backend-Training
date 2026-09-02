<?php

namespace App\Clients;

class StripeClient
{
    public function createCharge(array $payload): array
    {
        return [
            "id" => "1",
            "paid" => true
        ];
    }
}
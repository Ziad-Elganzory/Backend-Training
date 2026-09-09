<?php

namespace App\Contracts\Contracts;

interface PaymentGateway
{
    public function charge(int $amountInCents):string;
}

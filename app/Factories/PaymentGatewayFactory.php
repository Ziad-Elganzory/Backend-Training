<?php

namespace App\Factories;

use App\Adapters\LocalSmsAdapter;
use App\Adapters\PaymobPaymentAdapter;
use App\Adapters\StripePaymentAdapter;
use App\Adapters\TwilioSmsAdapter;
use App\Contracts\PaymentGateway;
use App\Contracts\SmsSender;
use InvalidArgumentException;

class PaymentGatewayFactory
{
    public static function make(?string $driver): PaymentGateway
    {    
        return match ($driver) {
            'stripe' => app()->make(StripePaymentAdapter::class),
            'paymob' => app()->make(PaymobPaymentAdapter::class,[
                "merchantRef" => "merchant_1"
            ]),
            default => throw new InvalidArgumentException("Invalid Payment Provider")
        };
    }
}
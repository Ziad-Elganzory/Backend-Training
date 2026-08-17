<?php

namespace App\Services;

use App\Events\PaymentSucceeded;
use Illuminate\Support\Facades\Log;

class PaymentService
{
    public function createPayment(array $data)
    {
        PaymentSucceeded::dispatch($data);
        return $data;
    }
}
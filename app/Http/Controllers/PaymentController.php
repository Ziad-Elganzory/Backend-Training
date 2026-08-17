<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(private PaymentService $paymentService){}
    public function createPayment(Request $request)
    {
        $validated = $request->validate([
            "payment_id" => ['required','numeric'],
            "order_id" => ['required','numeric'],
            "user_email" => ['required','email'],
            "amount" => ['required','numeric'],
        ]);

        $payment = $this->paymentService->createPayment($validated);

        return response()->json([
            "message" => "Payment processed successfully",
            "payment_id"=> $payment['payment_id']
        ]);
    }
}

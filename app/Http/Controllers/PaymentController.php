<?php

namespace App\Http\Controllers;

use App\Services\CheckoutService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct(
        protected CheckoutService $checkout
    )
    {}
    public function chargeCustomer(Request $request)
    {
        $result = $this->checkout->pay($request->integer('amount'));
        return response()->json($result);
    }
}

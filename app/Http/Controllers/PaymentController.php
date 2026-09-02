<?php

namespace App\Http\Controllers;

use App\Factories\PaymentGatewayFactory;
use Illuminate\Http\Request;
use InvalidArgumentException;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        if($request->integer("amount") <= 0){
            return response()->json([
                "error" => "Amount should be greater than 0"
            ], 400);
        }

        try {
            $payment = PaymentGatewayFactory::make($request->string("driver")->toString());
            $result = $payment->charge(
                $request->string("customer_id")->toString(),
                $request->integer("amount"),
                $request->string("currency")->toString(),
            );
            return response()->json($result);
        } catch(InvalidArgumentException $e){
            return response()->json([
                "error" => $e->getMessage()
            ], 400);
        }
    }
}

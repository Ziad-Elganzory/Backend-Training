<?php

namespace App\Http\Controllers;

use App\Facades\CheckoutFacade;
use Illuminate\Http\Request;
use InvalidArgumentException;

class CheckoutController extends Controller
{
    public function checkout(Request $request,CheckoutFacade $checkout){
        $order = [
            "items" => $request->input("items",[]),
            "customer_id" => $request->integer("customer_id"),
            "amount" => $request->float("amount"),
            "email" => $request->string("email")->toString()
        ];
    
        try{
            $result = $checkout->place($order);
    
            return response()->json([
                "message" => "order placed successfully",
                "data" => $result
            ]);
        }catch(InvalidArgumentException $e){
            return response()->json([
                "error" => $e->getMessage()
            ],400);
        }
    }
}

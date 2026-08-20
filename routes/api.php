<?php

use App\Facades\CheckoutFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/plain/facade",function(Request $request,CheckoutFacade $checkout){
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
        ]);
    }
});
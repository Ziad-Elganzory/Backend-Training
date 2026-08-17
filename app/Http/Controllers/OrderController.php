<?php

namespace App\Http\Controllers;

use App\Events\OrderPlaced;
use App\Models\Order;
use App\Services\OrederService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(private OrederService $orederService){}
    public function placeOrder(Request $request){
        $validated = $request->validate([
            'order_id'=> ['required', 'numeric'],
            "email" => ['required','email'],
            'total' => ['required', 'numeric','min:0'],
        ]);
        $order = $this->orederService->createOrder($validated);

        return response()->json([
            "message"=> "Order Placed Successfully",
            "order_id" => $order->order_id
        ]);
    }
}

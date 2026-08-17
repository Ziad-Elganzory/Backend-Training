<?php

namespace App\Http\Controllers;

use App\Services\ShippingCalculator;
use App\Strategies\Shipping\WeightBasedShippingStrategy;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function __construct(private ShippingCalculator $calculator){}
    public function calculateShipping(Request $request)
    {
        $type = $request->input("type");
        $weight = $request->input("weight");
        $order_total= $request->input("order_total");
        return response()->json([
            "type" => $type,
            "shipping_cost" => (float) $this->calculator->calculate($weight,$order_total,$type)
        ]);
    }
}

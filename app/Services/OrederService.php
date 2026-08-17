<?php

namespace App\Services;

use App\Events\OrderPlaced;
use App\Models\Order;

class OrederService
{
    public function createOrder(array $data)
    {
        $order = Order::create($data);
        OrderPlaced::dispatch($order);
        return $order;
    }
}
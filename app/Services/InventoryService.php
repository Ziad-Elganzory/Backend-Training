<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class InventoryService
{
    public function reserve(array $items)
    {
        Log::info("Reserved stock",[
            "order"=>$items
        ]);
        return "Reserved stock";
    }
}
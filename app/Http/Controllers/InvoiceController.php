<?php

namespace App\Http\Controllers;

use App\Services\TaxCalculatorService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function show()
    {
        $tax = app(TaxCalculatorService::class)->calculate(1000);
        return response()->json([
            'tax' => $tax
        ]);
    }
}

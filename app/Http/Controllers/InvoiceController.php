<?php

namespace App\Http\Controllers;

use App\Services\TaxCalculatorService;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function __construct(private TaxCalculatorService $taxCalculatorService){}
    public function show()
    {
        return response()->json([
            'tax' => $this->taxCalculatorService->calculate(1000)
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Builders\InvoiceBuilder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function build(Request $request){
        $builder = (new InvoiceBuilder())
            ->forCustomer($request->string("customer")->toString());

        foreach($request->input("items",[]) as $item){
            $builder->addItem(
                $item['name'],
                (float) $item['price'],
                (int) $item['qty'],
            );
        }

        if($request->filled('tax_percent')){
            $builder->withTax((float) $request->input('tax_percent'));
        }

        if ($request->filled('discount')) {
            $builder->withDiscount((float) $request->input('discount'));
        }
        if ($request->filled('notes')) {
            $builder->withNotes($request->string('notes')->toString());
        }

        try{
            $invoice = $builder->build();
            return response()->json([
                "invoice" => $invoice
            ]);
        } catch(\Exception $e){
            return response()->json([
                "error" => $e
            ],400);
        }
    }
}

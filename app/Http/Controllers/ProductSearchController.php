<?php

namespace App\Http\Controllers;

use App\Builders\ProductSearchBuilder;
use Illuminate\Http\Request;

class ProductSearchController extends Controller
{
    public function search(Request $request){

        $builder = new ProductSearchBuilder();

        if ($request->filled('name')) {
            $builder->named($request->string('name')->toString());
        }
        
        if ($request->filled('min_price')) {
            $builder->minPrice((float) $request->input('min_price'));
        }
        
        if ($request->filled('max_price')) {
            $builder->maxPrice((float) $request->input('max_price'));
        }
        
        if ($request->filled('category')) {
            $builder->category($request->string('category')->toString());
        }
        
        if ($request->filled('sort')) {
            $builder->sortBy($request->string('sort')->toString());
        }
        
        if ($request->filled('limit')) {
            $builder->limit($request->integer('limit'));
        }

        try{
            $productSearch = $builder->build();
            return response()->json($productSearch);
        } catch(\Exception $e){
            return response()->json($e,400);
        }
    }
}

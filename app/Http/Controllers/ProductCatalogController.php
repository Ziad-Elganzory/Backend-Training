<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function __construct(private ProductCatalogService $productCatalogService){}
    public function index(){
        return response()->json($this->productCatalogService->getProducts());
    }
    public function refresh(){
        $this->productCatalogService->refreshProductsCatalogCache();
        return response()->json([
            "message" => "Products Catalog Refreshed Successfully"
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\ProductCatalogService;
use Illuminate\Http\Request;

class ProductCatalogController extends Controller
{
    public function __construct(private ProductCatalogService $productCatalogService){}
    public function index(){
        return $this->productCatalogService->getProducts();
    }
}

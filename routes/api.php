<?php

use App\Http\Controllers\ProductCatalogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products/catalog',[ProductCatalogController::class,'index']);
Route::post('/products/catalog/refresh',[ProductCatalogController::class,'refresh']);
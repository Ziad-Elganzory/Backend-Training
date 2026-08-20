<?php

use App\Facades\CheckoutFacade;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReportExportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/orders/place",[CheckoutController::class,'checkout']);

Route::post("/reports/export",[ReportExportController::class,'export']);
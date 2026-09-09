<?php

use App\Http\Controllers\GreetingController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Mini Practice
Route::post('/pay',[PaymentController::class,'chargeCustomer']);

//Mini Project
Route::get('/greetings',[GreetingController::class,'greeting']);
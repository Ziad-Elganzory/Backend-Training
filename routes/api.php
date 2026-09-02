<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SmsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/sms/send', [SmsController::class, 'send']);
Route::post("/payments/charge",[PaymentController::class,'pay']);
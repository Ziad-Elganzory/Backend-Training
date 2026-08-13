<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SingletonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/settings', [SingletonController::class,'settings']);
Route::get('/invoice',[InvoiceController::class,'show']);
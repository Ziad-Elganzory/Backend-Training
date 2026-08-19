<?php

use App\Builders\EmailBuilder;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductSearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/email',function(){
    $email = (new EmailBuilder())
        ->to('ziad@example.com')
        ->subject('Welcome')
        ->body('Thanks for joining')
        ->cc('ops@example.com')
        ->attach('guide.pdf')
        ->build();
    return response()->json(["email" => $email]);
});

Route::post("/invoices/build",[InvoiceController::class,'build']);

Route::post("/products/search",[ProductSearchController::class,'search']);
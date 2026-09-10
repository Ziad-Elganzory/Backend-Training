<?php

use App\Http\Controllers\V1\GreetingController;
use App\Http\Controllers\V2\GreetingController as V2GreetingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//Mini Practice
//Practice A
Route::prefix('v1')->group(function(){
    Route::get('/welcome',[GreetingController::class,'greet']);
});

//Practice B
Route::prefix('v2')->group(function(){
    Route::get('/welcome',[V2GreetingController::class,'greet']);
});
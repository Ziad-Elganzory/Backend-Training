<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/users')->group(function(){
    Route::get('',[UserController::class,'index']);
    Route::post('create',[UserController::class,'store']);
    Route::get('/{id}',[UserController::class,'show']);
    Route::put('/{id}',[UserController::class,'update']);
    Route::delete('/{id}',[UserController::class,'destroy']);
});

// Mini Practice
Route::get('/paginated/users',[UserController::class,'paginated']);
<?php

use App\Factories\ExporterFactory;
use App\Http\Controllers\NotificationChannelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/export/{format}', function (Request $request, string $format) {
    $exporter = ExporterFactory::make($format);
    return response($exporter->export([
        'name' => 'John Doe',
        'role' => 'Backend Developer',
    ]))
        ->header('Content-Type', 'text/' . $format)
        ->header('Content-Disposition', 'attachment; filename="export.' . $format . '"');
});

Route::post('/notifications/send/{channel}', [NotificationChannelController::class, 'send']);
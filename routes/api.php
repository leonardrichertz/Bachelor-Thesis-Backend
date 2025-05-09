<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WeatherDataController;
use App\Http\Controllers\AuthenticationController;

Route::middleware(['throttle:api'])->post('login', [AuthenticationController::class, 'login']);

Route::middleware(['auth:sanctum', 'throttle:api', 'abilities:weather:all'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('weather', [WeatherDataController::class, 'index']);
    Route::get('coordinates', [WeatherDataController::class, 'coordinates']);
    Route::get('locations', [LocationController::class, 'index']);
    Route::post('locations', [LocationController::class, 'store']);
    Route::delete('locations', [LocationController::class, 'remove']);
    Route::post('/logout', [AuthenticationController::class, 'logout']);

});

Route::fallback(function () {
    return response()->json(['message' => 'Route not found'], 404);
});
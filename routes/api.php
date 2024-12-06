<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\WeatherDataController;
use App\Http\Controllers\AuthenticationController;

Route::post(uri:'login', action: [AuthenticationController::class, 'login']);

Route::get(uri: '/user', action: function (Request $request): mixed {
    return $request->user();
})->middleware(middleware: 'auth:sanctum');


Route::get(uri: 'weather', action: [WeatherDataController::class, 'index']);

Route::get(uri: 'coordinates', action: [WeatherDataController::class, 'coordinates']);

Route::get(uri: 'locations', action: [LocationController::class, 'index']);  

Route::post(uri: 'locations', action: [LocationController::class, 'store']);

Route::delete(uri: 'locations/{id}', action: [LocationController::class, 'remove']);
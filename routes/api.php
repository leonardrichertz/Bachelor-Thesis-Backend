<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WeatherDataController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('student', [StudentController::class, 'index']);

Route::post('student', [StudentController::class, 'store']);

Route::put('student/edit/{id}', [StudentController::class, 'update']);

Route::get('weather', [WeatherDataController::class, 'index']);
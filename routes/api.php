<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\SystemController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/home', [SystemController::class, 'index']);
Route::get('/all', [SystemController::class, 'all']);
Route::get('/dashboard', [SystemController::class, 'dashboard']);
Route::get('/calendar', [TrainingsController::class, 'calendar']);
Route::get('/training', [TrainingsController::class, 'training']);
Route::get('/training/info', [TrainingsController::class, 'info']);
Route::get('/training/resources', [TrainingsController::class, 'resources']);
Route::get('/trainings/user', [TrainingsController::class, 'user']);
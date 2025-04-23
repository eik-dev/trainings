<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrainerController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'index']);
});

Route::post('/trainer/create', [TrainerController::class, 'create']);
Route::get('/trainers', [TrainerController::class, 'index']);

Route::get('/home', [SystemController::class, 'index']);
Route::get('/all', [SystemController::class, 'all']);
Route::get('/dashboard', [SystemController::class, 'dashboard']);
Route::get('/calendar', [TrainingsController::class, 'calendar']);

Route::get('/training', [TrainingsController::class, 'training']);
Route::post('/training', [TrainingsController::class, 'create']);

Route::get('/training/info', [TrainingsController::class, 'info']);
Route::get('/training/resources', [TrainingsController::class, 'resources']);
Route::get('/trainings/user', [TrainingsController::class, 'user']);
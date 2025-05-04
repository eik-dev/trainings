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

Route::post('/trainers', [TrainerController::class, 'create']);
Route::get('/trainers', [TrainerController::class, 'index']);

Route::get('/home', [SystemController::class, 'index']);
Route::get('/all', [SystemController::class, 'all']);
Route::get('/dashboard', [SystemController::class, 'dashboard']);
Route::get('/calendar', [TrainingsController::class, 'calendar']);

Route::get('/trainings', [TrainingsController::class, 'listTrainings']);
Route::get('/training/drafts', [TrainingsController::class, 'draft']);
Route::get('/training/check', [TrainingsController::class, 'checkTraining']);
Route::get('/training/fromName', [TrainingsController::class, 'fromName']);
Route::get('/training/related', [TrainingsController::class, 'related']);
Route::get('/training/{training}', [TrainingsController::class, 'training']);
Route::put('/training/{training}', [TrainingsController::class, 'update']);
Route::post('/training', [TrainingsController::class, 'create']);
Route::post('/training/pricing', [TrainingsController::class, 'pricing']);
Route::post('/training/media', [TrainingsController::class, 'media']);
Route::post('/training/module-media', [TrainingsController::class, 'moduleMedia']);
Route::post('/training/modules', action: [TrainingsController::class, 'modules']);

Route::get('/training/resources', [TrainingsController::class, 'resources']);
Route::get('/trainings/user', [TrainingsController::class, 'user']);
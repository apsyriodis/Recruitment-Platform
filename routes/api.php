<?php

use App\Http\Controllers\StepController;
use App\Http\Controllers\StepStatusHistoryController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->group(function () {
    Route::resource('timeline', TimelineController::class)->only(['index', 'show', 'store']);
    Route::post('step', [StepController::class, 'store']);
    Route::post('step-status-history', [StepStatusHistoryController::class, 'store']);
// });

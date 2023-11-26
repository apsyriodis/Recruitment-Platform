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

Route::get('timeline', [TimelineController::class, 'show']);
Route::post('timeline', [TimelineController::class, 'store']);

Route::resource('step', StepController::class)->only(['store']);

Route::post('step-status-history', [StepStatusHistoryController::class, 'store']);

<?php

use App\Http\Controllers\StepController;
use App\Http\Controllers\TimelineController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/timeline', [TimelineController::class, 'index'])->name('home');
Route::post('/timeline', [TimelineController::class, 'store'])->name('timeline.store');
Route::get('/timeline/new', [TimelineController::class, 'create'])->name('timeline.create');

Route::post('/step/{timeline_id}', [StepController::class, 'store'])->name('step.store');
Route::get('/step/new/{timeline_id}', [StepController::class, 'create'])->name('step.create');

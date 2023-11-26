<?php

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

Route::post('/', [TimelineController::class, 'store'])->name('timeline.store');
Route::get('/', [TimelineController::class, 'index'])->name('home');
Route::get('/new-timeline', [TimelineController::class, 'create'])->name('timeline.create');
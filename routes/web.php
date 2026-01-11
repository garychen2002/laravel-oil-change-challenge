<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::post('/check', [CarController::class, 'store'])->name('check');
Route::get('/result/{id}', [CarController::class, 'show'])->name('result');

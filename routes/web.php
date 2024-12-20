<?php

use App\Http\Controllers\ImportController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/get-orders', [OrderController::class, 'index'])->name('get-orders');
Route::get('/import', [ImportController::class, 'index'])->name('import');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authinctation;

Route::post('/registerAsCompamy', [Authinctation::class, 'registerCompaany']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
    });

    Route::prefix('company')->middleware(['company'])->group(function () {
    });

    Route::prefix('employee')->middleware(['employee'])->group(function () {
        //this new ?
    });
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authinctation;

Route::post('register', [Authinctation::class, 'register']);
Route::post('login', [Authinctation::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', [Authinctation::class, 'logout']);
    Route::prefix('admin')->middleware(['admin'])->group(function () {
    });

    Route::prefix('company')->middleware(['company'])->group(function () {
    });

    Route::prefix('employee')->middleware(['employee'])->group(function () {
    });
});

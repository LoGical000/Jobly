<?php

use Illuminate\Http\Request;
use App\Http\Middleware\company;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authinctation;
use App\Http\Controllers\Common\HeplerController;
use App\Http\Controllers\Company\CompanyController;

Route::post('register', [Authinctation::class, 'register']);
Route::post('login', [Authinctation::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('storeImage', [HeplerController::class, 'StoreImg']);
    Route::post('logout', [Authinctation::class, 'logout']);
    Route::prefix('admin')->middleware(['admin'])->group(function () {
    });

    Route::prefix('company')->middleware([company::class])->group(function () {
        Route::post('create/company', [CompanyController::class, 'createComp']);
    });

    Route::prefix('employee')->middleware(['employee'])->group(function () {
    });
});

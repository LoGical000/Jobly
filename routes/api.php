<?php

use Illuminate\Http\Request;
use App\Http\Middleware\company;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authinctation;
use App\Http\Controllers\Common\CategoryController;
use App\Http\Controllers\Common\HeplerController;
use App\Http\Controllers\Common\SectionController;
use App\Http\Controllers\Company\CompanyController;

Route::post('register', [Authinctation::class, 'register']);
Route::post('login', [Authinctation::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('storeImage', [HeplerController::class, 'StoreImg']);
    Route::post('logout', [Authinctation::class, 'logout']);
    Route::get('index', [Authinctation::class, 'index']);
    Route::post('update/{id}', [Authinctation::class, 'update']);
    Route::post('delete/{id}', [Authinctation::class, 'delete']);


    Route::get('section/index', [SectionController::class, 'index']);
    Route::get('section/getSectionByCaateogry/{category_id}', [SectionController::class, 'getSectionByCaateogry']);
    Route::post('section/create/{category_id}', [SectionController::class, 'create']);

    Route::get('category/index', [CategoryController::class, 'index']);
    Route::post('category/create', [CategoryController::class, 'create']);



    Route::prefix('admin')->middleware(['admin'])->group(function () {
    });

    Route::prefix('company')->middleware([company::class])->group(function () {
        Route::get('index/company', [CompanyController::class, 'index']);
        Route::post('create/company', [CompanyController::class, 'createComp']);
        Route::post('update/company/{id}', [CompanyController::class, 'updateComp']);
        Route::post('delete/company/{id}', [CompanyController::class, 'deleteComp']);
    });

    Route::prefix('employee')->middleware(['employee'])->group(function () {
    });
});

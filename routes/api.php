<?php

use Illuminate\Http\Request;
use App\Http\Middleware\company;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authinctation;
use App\Http\Controllers\Common\AddressController;
use App\Http\Controllers\Common\CategoryController;
use App\Http\Controllers\Common\HeplerController;
use App\Http\Controllers\Common\SectionController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\VacancyController;

Route::post('register', [Authinctation::class, 'register']);
Route::post('login', [Authinctation::class, 'login']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('storeImage', [HeplerController::class, 'StoreImg']);
    Route::post('logout', [Authinctation::class, 'logout']);
    Route::get('index', [Authinctation::class, 'index']);
    Route::post('update/{id}', [Authinctation::class, 'update']);
    Route::post('delete/{id}', [Authinctation::class, 'delete']);

    Route::post('address/create', [AddressController::class, 'create']);
    Route::post('address/update/{id}', [AddressController::class, 'update']);
    Route::post('address/delete/{id}', [AddressController::class, 'delete']);



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

        Route::get('vacancy/index', [VacancyController::class, 'index']);
        Route::get('vacancy/getvacancyByCompany/{id}', [CompanyController::class, 'getvacancyByCompany']);
        Route::post('vacancy/create', [VacancyController::class, 'create']);
        Route::post('vacancy/update/{id}', [VacancyController::class, 'update']);
        Route::post('vacancy/delete/{id}', [VacancyController::class, 'delete']);
    });

    Route::prefix('employee')->middleware(['employee'])->group(function () {
    });
});

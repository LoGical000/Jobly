<?php

use Illuminate\Http\Request;
use App\Http\Middleware\company;
use App\Http\Middleware\employee;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Authinctation;
use App\Http\Controllers\Common\UserController;
use App\Http\Controllers\Common\HeplerController;
use App\Http\Controllers\Common\AddressController;
use App\Http\Controllers\Common\SectionController;
use App\Http\Controllers\Common\CategoryController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\VacancyController;
use App\Http\Controllers\Common\JobsRequestController;
use App\Http\Middleware\Ban;

Route::post('register', [Authinctation::class, 'register']);
Route::post('login', [Authinctation::class, 'login']);


Route::middleware(['auth:sanctum', 'ban'])->group(function () {


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



    Route::post('vacancy/applyVacancy/{vacancy_id}', [VacancyController::class, 'applayJobs']);

    Route::get('vacancy/getjobsRequest', [JobsRequestController::class, 'getUserjobsRequest']);
    Route::get('vacancy/getRequestOnVacancy/{vacancy_id}', [JobsRequestController::class, 'getRequestOnVacancy']);

    Route::post('ReqquestJobs/delete/{jobs_request_id}', [JobsRequestController::class, 'delete']);
    Route::post('ReqquestJobs/accept/{jobs_request_id}', [JobsRequestController::class, 'accept']);
    Route::post('ReqquestJobs/reject/{jobs_request_id}', [JobsRequestController::class, 'reject']);



    Route::middleware(['admin'])->group(function () {

        Route::get('user/index/{user_id}', [UserController::class, 'index']);
        Route::post('user/delete/{user_id}', [UserController::class, 'delete']);
        Route::post('user/ban/{user_id}', [UserController::class, 'BanUser']);
        Route::post('user/unban/{user_id}', [UserController::class, 'UnBanUser']);
    });




    Route::prefix('company')->middleware(['company'])->group(function () {
        Route::get('index/company', [CompanyController::class, 'index']);
        Route::post('create/company', [CompanyController::class, 'createComp']);
        Route::post('update/company/{company_id}', [CompanyController::class, 'updateComp']);
        Route::post('delete/company/{company_id}', [CompanyController::class, 'deleteComp']);

        Route::get('vacancy/index', [VacancyController::class, 'index']);
        Route::post('vacancy/create', [VacancyController::class, 'create']);
        Route::post('vacancy/update/{vacancy_id}', [VacancyController::class, 'update']);
        Route::post('vacancy/delete/{vacancy_id}', [VacancyController::class, 'delete']);
        Route::get('vacancy/getvacancyByCompany/{company_id}', [CompanyController::class, 'getvacancyByCompany']);
    });

    Route::prefix('employee')->middleware(['employee'])->group(function () {
    });
});

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
use App\Http\Controllers\common\locationController;
use App\Http\Middleware\Ban;

Route::post('register', [Authinctation::class, 'register']);
Route::post('login', [Authinctation::class, 'login']);
Route::post('create/user', [Authinctation::class, 'register_app']);
Route::post('login/employee', [Authinctation::class, 'login_app']);


Route::middleware(['auth:sanctum', 'ban'])->group(function () {



    Route::post('storeImage', [HeplerController::class, 'StoreImg']);
    Route::post('logout', [Authinctation::class, 'logout']);
    Route::get('index', [Authinctation::class, 'index']);
    Route::post('update/{id}', [Authinctation::class, 'update']);
    Route::post('delete/{id}', [Authinctation::class, 'delete']);

    Route::post('address/create', [AddressController::class, 'create']);
    Route::post('address/update/{id}', [AddressController::class, 'update']);
    Route::post('address/delete/{id}', [AddressController::class, 'delete']);

    Route::post('location/create/{vacancy_id}', [locationController::class, 'create']);
    Route::post('location/update/{id}', [locationController::class, 'update']);
    Route::post('location/delete/{id}', [locationController::class, 'delete']);


    Route::get('section/index', [SectionController::class, 'index']);
    Route::get('section/getSectionByCaateogry/{category_id}', [SectionController::class, 'getSectionByCaateogry']);
    Route::post('section/create/{category_id}', [SectionController::class, 'create']);

    Route::get('category/index', [CategoryController::class, 'index']);
    Route::post('category/create', [CategoryController::class, 'create']);



    Route::post('vacancy/applyVacancy/{vacancy_id}', [VacancyController::class, 'applayJobs']);

    Route::get('vacancy/getjobsRequest', [JobsRequestController::class, 'getUserjobsRequest']);
    Route::get('vacancy/getRequestOnVacancy/{vacancy_id}', [JobsRequestController::class, 'getRequestOnVacancy']);


    //----this for get the company-------------/
        Route::get('company', [UserController::class, 'company']);

        // Route::get('users', [UserController::class, 'users']);

    //----------------/

    Route::post('ReqquestJobs/delete/{jobs_request_id}', [JobsRequestController::class, 'delete']);
    Route::post('ReqquestJobs/accept/{jobs_request_id}', [JobsRequestController::class, 'accept']);
    Route::post('ReqquestJobs/reject/{jobs_request_id}', [JobsRequestController::class, 'reject']);


    Route::get('vacancy/index/companies', [VacancyController::class, 'getAllJobsForCompany']);
    Route::get('vacancy/index/freelance', [VacancyController::class, 'getAllFreeLanceJobs']);
    Route::get('vacancy/getByCategory/{category_id}', [VacancyController::class, 'getJobsByCategory']);
    Route::post('vacancy/create', [VacancyController::class, 'create_app']);
    Route::get('vacancy/delete/{id}', [VacancyController::class, 'delete']);
    Route::get('vacancy/show/{id}', [VacancyController::class, 'getJob']);





    Route::post('auth_request/create', [\App\Http\Controllers\Common\AuthRequestController::class, 'create']);
    Route::post('auth_request/delete', [\App\Http\Controllers\Common\AuthRequestController::class, 'delete']);



    Route::middleware(['admin'])->group(function () {
        Route::get('user/index/{user_id}', [UserController::class, 'index']);
        Route::post('user/delete/{user_id}', [UserController::class, 'delete']);
        Route::post('user/ban/{user_id}', [UserController::class, 'BanUser']);
        Route::post('user/unban/{user_id}', [UserController::class, 'UnBanUser']);
    });




    Route::prefix('company')->middleware(['company'])->group(function () {
        Route::get('index/company', [CompanyController::class, 'index']);
        // Route::get('index/company', [CompanyController::class, 'index']);
        Route::post('create/company', [CompanyController::class, 'createComp']);
        Route::post('update/company/{company_id}', [CompanyController::class, 'updateComp']);
        Route::post('delete/company/{company_id}', [CompanyController::class, 'deleteComp']);

        // Route::get('vacancy/index', [VacancyController::class, 'index']);
        Route::post('vacancy/create', [VacancyController::class, 'create']);
        Route::post('vacancy/update/{vacancy_id}', [VacancyController::class, 'update']);
        Route::post('vacancy/delete/{vacancy_id}', [VacancyController::class, 'delete']);
        Route::get('vacancy/getvacancyByCompany/{company_id}', [CompanyController::class, 'getvacancyByCompany']);

        Route::get('vacancy/singleVacancy/{vacancy_id}', [VacancyController::class, 's_index']);
    });



    Route::prefix('employee')->middleware(['employee'])->group(function () {

        Route::post('create/employee', [\App\Http\Controllers\Employee\EmployeeController::class, 'create']);

        Route::post('create/skill', [\App\Http\Controllers\Employee\SkillController::class, 'create']);
        Route::get('show/skill', [\App\Http\Controllers\Employee\SkillController::class, 'show']);
        Route::post('upload/video', [\App\Http\Controllers\Employee\EmployeeController::class, 'uploadVideo']);
        Route::post('favorite/add', [\App\Http\Controllers\Employee\Employee_favController::class, 'create']);
        Route::get('favorite/show', [\App\Http\Controllers\Employee\Employee_favController::class, 'show']);
        Route::post('cv/upload', [\App\Http\Controllers\Employee\EmployeeController::class, 'uploadCV']);

        Route::get('vacancy/getFavorite', [VacancyController::class, 'getJobsByFavorite']);








        Route::post('update', [\App\Http\Controllers\Employee\EmployeeController::class, 'update']);
        Route::get('show', [\App\Http\Controllers\Employee\EmployeeController::class, 'show']);



    });

});


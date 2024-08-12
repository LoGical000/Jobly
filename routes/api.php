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
    Route::get('section/getSectionByCategory/{category_id}', [SectionController::class, 'getSectionByCategory']);
    Route::post('section/create/{category_id}', [SectionController::class, 'create']);


    Route::get('category/index', [CategoryController::class, 'index']);
    Route::post('category/create', [CategoryController::class, 'create']);



    Route::post('vacancy/applyVacancy/{vacancy_id}', [VacancyController::class, 'applayJobs']);

    /* here i work */
    Route::get('vacancy/getjobsRequest', [JobsRequestController::class, 'getUserjobsRequest']);
    Route::get('vacancy/getRequestOnVacancy/{vacancy_id}', [JobsRequestController::class, 'getRequestOnVacancy']);
    Route::post('vacancy/reject/{jobs_request_id}', [JobsRequestController::class, 'reject']);
    Route::post('vacancy/accept/{jobs_request_id}', [JobsRequestController::class, 'accept']);



    Route::get('company', [UserController::class, 'company']);
    Route::get('employe', [UserController::class, 'employe']);

    Route::post('ReqquestJobs/delete/{jobs_request_id}', [JobsRequestController::class, 'delete']);
    // Route::post('ReqquestJobs/accept/{jobs_request_id}', [JobsRequestController::class, 'accept']);
    Route::post('ReqquestJobs/reject/{jobs_request_id}', [JobsRequestController::class, 'reject']);


    Route::get('vacancy/index/companies', [VacancyController::class, 'getAllJobsForCompany']);
    Route::get('vacancy/index/freelance', [VacancyController::class, 'getAllFreeLanceJobs']);
    Route::get('vacancy/getByCategory/{category_id}', [VacancyController::class, 'getJobsByCategory']);
    Route::post('vacancy/create', [VacancyController::class, 'create_app']);
    Route::get('vacancy/delete/{id}', [VacancyController::class, 'delete']);
    Route::get('vacancy/show/{id}', [VacancyController::class, 'getJob']);
    Route::get('vacancy/filter', [VacancyController::class, 'getFilteredVacancies']);
    Route::get('vacancy/search', [VacancyController::class, 'search']);
    Route::get('vacancy/company/{id}', [VacancyController::class, 'getAllJobsForOneCompany']);





    Route::post('auth_request/create', [\App\Http\Controllers\Common\AuthRequestController::class, 'create']);
    Route::post('auth_request/delete/', [\App\Http\Controllers\Common\AuthRequestController::class, 'delete']);
    Route::post('auth_request/accept/{id}', [\App\Http\Controllers\Common\AuthRequestController::class, 'accept']);
    Route::post('auth_request/reject/{id}', [\App\Http\Controllers\Common\AuthRequestController::class, 'reject']);
    Route::get('auth_request/getRequest', [\App\Http\Controllers\Common\AuthRequestController::class, 'getRequest']);



    Route::get('company/index', [CompanyController::class, 'getCompanies']);
    Route::get('company/{id}', [CompanyController::class, 'getCompanyInfo']);



    Route::post('advice/like/{id}', [\App\Http\Controllers\Common\AdviceController::class, 'like']);
    Route::get('advice/indexByLike', [\App\Http\Controllers\Common\AdviceController::class, 'indexByLike']);
    Route::get('advice/indexByDate', [\App\Http\Controllers\Common\AdviceController::class, 'indexByDate']);
    Route::post('advice/report', [\App\Http\Controllers\Common\AdviceController::class, 'report']);
    Route::put('advice/update/{id}', [\App\Http\Controllers\Common\AdviceController::class, 'update']);
    Route::delete('advice/delete/{id}', [\App\Http\Controllers\Common\AdviceController::class, 'delete']);


    Route::post('question/create', [\App\Http\Controllers\Common\QuestionController::class, 'create']);
    Route::get('question/indexByDate', [\App\Http\Controllers\Common\QuestionController::class, 'indexByDate']);
    Route::get('question/indexBySection/{id}', [\App\Http\Controllers\Common\QuestionController::class, 'indexBySection']);
    Route::post('question/like/{id}', [\App\Http\Controllers\Common\QuestionController::class, 'like']);
    Route::delete('question/delete/{id}', [\App\Http\Controllers\Common\QuestionController::class, 'delete']);
    Route::put('question/update/{id}', [\App\Http\Controllers\Common\QuestionController::class, 'update']);
    Route::post('question/report', [\App\Http\Controllers\Common\QuestionController::class, 'report']);

    Route::post('answer/{id}', [\App\Http\Controllers\Common\AnswerController::class, 'create']);
    Route::get('answer/{id}', [\App\Http\Controllers\Common\AnswerController::class, 'getAnswers']);
    Route::put('answer/update/{id}', [\App\Http\Controllers\Common\AnswerController::class, 'update']);
    Route::delete('answer/{id}', [\App\Http\Controllers\Common\AnswerController::class, 'delete']);
    Route::post('answer/like/{id}', [\App\Http\Controllers\Common\AnswerController::class, 'like']);
    Route::post('report/answer', [\App\Http\Controllers\Common\AnswerController::class, 'report']);



    Route::middleware(['bluebadge'])->group(function () {
        Route::post('advice/create', [\App\Http\Controllers\Common\AdviceController::class, 'create']);
    });



    Route::middleware(['admin'])->group(function () {
        Route::get('user/index/{user_id}', [UserController::class, 'index']);
        Route::post('user/delete/{user_id}', [UserController::class, 'delete']);
        Route::post('user/ban/{user_id}', [UserController::class, 'BanUser']);
        Route::post('user/unban/{user_id}', [UserController::class, 'UnBanUser']);
        Route::get('user/ban', [UserController::class, 'usereBan']);
    });




    Route::prefix('company')->middleware(['company'])->group(function () {
        Route::get('index/company', [CompanyController::class, 'index']);
        // Route::get('index/company', [CompanyController::class, 'index']);
        Route::post('create/company', [CompanyController::class, 'createComp']);
        Route::post('update/company/{company_id}', [CompanyController::class, 'updateComp']);
        Route::post('delete/company/{company_id}', [CompanyController::class, 'deleteComp']);
        Route::get('profile/company/{company_id}', [CompanyController::class, 'profile']);



        // Route::get('vacancy/index', [VacancyController::class, 'index']);
        Route::post('vacancy/create', [VacancyController::class, 'create']);
        Route::post('vacancy/update/{vacancy_id}', [VacancyController::class, 'update']);
        Route::post('vacancy/delete/{vacancy_id}', [VacancyController::class, 'delete']);
        Route::get('vacancy/getvacancyByCompany/{company_id}', [CompanyController::class, 'getvacancyByCompany']);

        Route::get('vacancy/singleVacancy/{vacancy_id}', [VacancyController::class, 's_index']);
        Route::get('profile/{id}', [\App\Http\Controllers\Employee\EmployeeController::class, 'profile']);
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
        Route::get('vacancy/getMyApplications', [JobsRequestController::class, 'getUserJobApplications']);



        Route::get('ratings/company/{id}', [\App\Http\Controllers\Common\RatingController::class, 'getRatingsForCompany']);
        Route::post('ratings/create', [\App\Http\Controllers\Common\RatingController::class, 'create']);



        Route::get('ratings/company/{id}', [\App\Http\Controllers\Common\RatingController::class, 'getRatingsForCompany']);
        Route::post('ratings/create', [\App\Http\Controllers\Common\RatingController::class, 'create']);


        Route::post('update', [\App\Http\Controllers\Employee\EmployeeController::class, 'update']);
        Route::get('show', [\App\Http\Controllers\Employee\EmployeeController::class, 'show']);
        Route::get('profile/{id}', [\App\Http\Controllers\Employee\EmployeeController::class, 'profile']);



    });

});


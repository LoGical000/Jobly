<?php

namespace App\Repository\Models;

use App\Repository\Reapository;
use App\Models\Vacancy;
use App\Traits\UploadTrait;
use App\Class\HelperFunction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VacancyRepo extends Reapository
{
    use UploadTrait;

    public function __construct()
    {
        parent::__construct(Vacancy::class);
    }

    public function create(array $atter): Response
    {
        // $attributes['user_id'] = auth()->user()->id;
        $atter['user_id'] = auth()->user()->id;

        $vacancy = Vacancy::create($atter);

        $vacan = Vacancy::where('id', $vacancy->id)->with('section', 'location', 'user.company')->first();

        $responseData = [
            'company_name' => $vacan->user->company->company_name,
            'section' => $vacan->section->section,
            'vacancy_id' => $vacan->id,
            'user_id' => $vacan->user_id,
            'description' => $vacan->description,
            'vacancy_image' => $vacan->image,
            'job_type' => $vacan->job_type,
            'status' => $vacan->status,
            'requirements' => $vacan->requirements,
            'salary_range' => $vacan->salary_range,
            'application_deadline' => $vacan->application_deadline,
        ];

        return response()->json([
            'data' => $responseData,
        ]);
    }

    public function create_app($request)
    {
        $validatedData = $request->validated();
        $Data = collect($validatedData)->except('image')->toArray();
        $Data['user_id'] = Auth::id();
        $vacancy = Vacancy::create($Data);

        if ($request->has('image')) {
            $helper = new HelperFunction();
            $image = $helper->storeImage($request->image);
            $vacancy->image = $image;
            $vacancy->save();
        }

        return $this->apiResponse('success', $vacancy);
    }

    public function getAllJobsForCompany()
    {
        $vacancies = Vacancy::with(['location', 'user.company'])
            ->whereHas('user', function ($query) {
                $query->where('role', 2);
            })
            ->get();
        $vacancies = $vacancies->map(function ($vacancy) {
             return $this->formatVacancyResponse($vacancy);
        });


        return $this->apiResponse('success', $vacancies);
    }

    public function getAllJobsForEmployee()
    {
        $vacancies = Vacancy::with(['location', 'user.employee.image'])
            ->whereHas('user', function ($query) {
                $query->where('role', 1);
            })
            ->get();
        $vacancies = $vacancies->map(function ($vacancy) {
            return $this->formatVacancyResponse($vacancy);

        });


        return $this->apiResponse('success', $vacancies);
    }

    public function getFilteredVacancies($request)
<<<<<<< HEAD
    {
        $cities = $request->input('cities', []);
        $job_section_ids = $request->input('job_section_ids', []);
        $job_category_ids = $request->input('job_category_ids', []);
        $job_types = $request->input('job_types', []);

        $vacancies = Vacancy::with(['location', 'user.company', 'section']);

        if (!empty($cities)) {
            $vacancies->whereHas('location', function ($query) use ($cities) {
                $query->whereIn('city', $cities);
            });
        }

        if (!empty($job_section_ids)) {
            $vacancies->whereIn('jops_section_id', $job_section_ids);
        }

        if (!empty($job_category_ids)) {
            $vacancies->whereHas('section', function ($query) use ($job_category_ids) {
                $query->whereIn('jops_category_id', $job_category_ids);
            });
        }

        if (!empty($job_types)) {
            $vacancies->whereIn('job_type', $job_types);
        }

        $vacancies = $vacancies->get();

        $vacancies = $vacancies->map(function ($vacancy) {
            return $this->formatVacancyResponse($vacancy);
        });

        return $this->apiResponse('success', $vacancies);
    }

    public function getJobsByCategory($category_id)
=======
>>>>>>> 0a239b7b5b79f9b0069a408a9674c0baa7f517a5
    {
        $cities = $request->input('cities', []);
        $job_section_ids = $request->input('job_section_ids', []);
        $job_category_ids = $request->input('job_category_ids', []);
        $job_types = $request->input('job_types', []);

        $vacancies = Vacancy::with(['location', 'user.company', 'section']);

        if (!empty($cities)) {
            $vacancies->whereHas('location', function ($query) use ($cities) {
                $query->whereIn('city', $cities);
            });
        }

        if (!empty($job_section_ids)) {
            $vacancies->whereIn('jops_section_id', $job_section_ids);
        }

        if (!empty($job_category_ids)) {
            $vacancies->whereHas('section', function ($query) use ($job_category_ids) {
                $query->whereIn('jops_category_id', $job_category_ids);
            });
        }

        if (!empty($job_types)) {
            $vacancies->whereIn('job_type', $job_types);
        }

        $vacancies = $vacancies->get();

        $vacancies = $vacancies->map(function ($vacancy) {
            return $this->formatVacancyResponse($vacancy);
        });

        return $this->apiResponse('success', $vacancies);
    }

    public function getJobsByFavorite()
    {
        $user = Auth::user();
        $favoriteSectionIds = $user->employee->favorite->pluck('jops_section_id');

        $vacancies = Vacancy::with(['location', 'user.company', 'user.employee.image'])
            ->whereIn('jops_section_id', $favoriteSectionIds)
            ->get();

        $vacancies = $vacancies->map(function ($vacancy) {
            return $this->formatVacancyResponse($vacancy);
        });

        return $this->apiResponse('success', $vacancies);
    }

    public function getJob($id)
    {
        $vacancy = Vacancy::where('id', $id)->with(['location', 'user.company', 'user.employee.image'])->first();
        $vacancy = $this->formatVacancyResponse($vacancy);
        return $this->apiResponse('success', $vacancy);
    }

    public function search($request){
        $name = $request->name;
        $vacancies = Vacancy::where('description', 'LIKE', '%' . $name . '%')->get();

        $vacancies = $vacancies->map(function ($vacancy) {
            return $this->formatVacancyResponse($vacancy);
        });

        return $this->apiResponse('success', $vacancies);


    }


}

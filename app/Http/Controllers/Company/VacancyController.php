<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyRequest;
use App\Models\Vacancy;
use App\Models\Jobs_Request;
use App\Repository\Models\VacancyRepo;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new VacancyRepo();
    }

    public function index()
    {
        return $this->repo->index();
    }



    public function create(VacancyRequest $request)
    {
        $atter = $request->validated();
        return $this->repo->create($atter);
    }

    public function update(Request $request, int $id)
    {
        $Vacancy = Vacancy::where('id', '=', $id)->first();

        $Vacancy->update([
            'description' => $request->input('description') ?? $Vacancy['description'],
            'image' => $request->input('image') ?? $Vacancy['image'],
            'job_type' => $request->input('job_type') ?? $Vacancy['job_type'],
            'requirements' => $request->input('requirements') ?? $Vacancy['requirements'],
            'salary_range' => $request->input('salary_range') ?? $Vacancy['salary_range'],
            'application_deadline' => $request->input('application_deadline') ?? $Vacancy['application_deadline'],
            'status' => $request->input('status') ?? $Vacancy['status'],
            'jops_section_id' => $request->input('jops_section_id') ?? $Vacancy['jops_section_id'],
            'user_id' => $request->input('user_id') ?? $Vacancy['user_id'],
        ]);

        return response()->json([
            'usVacancyer' => $Vacancy
        ]);
    }

    public function delete(int $id)
    {
        return $this->repo->delete($id);
    }

    public function applayJobs(int $id)
    {
        $atter['user_id'] = auth()->user()->id;
        $atter['vacancy_id'] = $id;

        $request = Jobs_Request::create($atter);

        return response()->json([
            'data' => $request,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Jobs_Request;
use App\Models\Vacancy;
use App\Repository\Models\Jobs_RequestRepo;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobsRequestController extends Controller
{

    use ResponseTrait;
    private $repo;
    public function __construct()
    {
        $this->repo = new Jobs_RequestRepo();
    }
    public function getUserjobsRequest()
    {

        return response()->json([
            'data' => auth()->user()->jobRequests()
                ->with(['vacancy'])
                ->get(),
        ]);
    }

    public function getUserJobApplications()
    {
        return $this->repo->getUserJobApplications();

    }


    public function delete($jobs_request_id)
    {
        return $this->repo->delete($jobs_request_id);
    }

    public function getRequestOnVacancy($vacancy_id)
    {
        $data = Vacancy::where('id', $vacancy_id)->with(['jobRequests', 'jobRequests.user'])->first();
        return response()->json([
            'data' => $data
        ]);
    }

    public function accept($jobs_request_id)
    {
        $data = Jobs_Request::where('id', $jobs_request_id)->first();

        $data->update([
            'status' => "Accepted",
        ]);
        return response()->json([
            'data' => $data,
        ]);
    }

    public function reject($jobs_request_id)
    {
        $data = Jobs_Request::where('id', $jobs_request_id)->first();

        $data->update([
            'status' => "Rejected",
        ]);

        return response()->json([
            'data' => $data,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Common;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\Jobs_Request;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Http\Controllers\Controller;
use App\Notifications\AcceptRequest;
use App\Notifications\RejectRequest;
use Illuminate\Support\Facades\Auth;
use App\Repository\Models\Jobs_RequestRepo;


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

    public function getUserRequestsOnVacancy($id){

        return $this->repo->getUserRequestsOnVacancy($id);

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
        $job = Vacancy::where('id', $data['vacancy_id'])->first();
        $company = Company::where('id',$job['id'])->first();
        $user = User::where('id', $data['user_id'])->first();
        $user['company_name'] = $company['company_name'];
        $user['job_id'] = $job['id'];
        $user->notify(new AcceptRequest($user));

        return $this->apiResponse('success',$data);
    }

    public function reject($jobs_request_id)
    {
        $data = Jobs_Request::where('id', $jobs_request_id)->first();

        $data->update([
            'status' => "Rejected",
        ]);

        $job = Vacancy::where('id', $data['vacancy_id'])->first();
        $company = Company::where('id', $job['id'])->first();
        $user = User::where('id', $data['user_id'])->first();
        $user['company_name'] = $company['company_name'];
        $user['job_id'] = $job['id'];
        
        $user->notify(new RejectRequest($user));


        return $this->apiResponse('success',$data);

    }
}

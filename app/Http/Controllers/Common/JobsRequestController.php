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
        $user = Auth::user();

        $jobApplications = Jobs_Request::with(['vacancy.user', 'vacancy.location'])
            ->where('user_id', $user->id)
            ->get();

        $formattedJobApplications = $jobApplications->map(function ($jobApplication) {
            $vacancyUser = $jobApplication->vacancy->user;
            $publisherName = $vacancyUser ? ($vacancyUser->role == 2 && $vacancyUser->company ? $vacancyUser->company->company_name : $vacancyUser->name) : null;
            $publisherPhoto = $vacancyUser && $vacancyUser->role == 1 && $vacancyUser->employee && $vacancyUser->employee->image
                ? '/Employees/' . $vacancyUser->employee->image->filename
                : ($vacancyUser && $vacancyUser->role == 2 && $vacancyUser->company ? $vacancyUser->company->Commercial_Record : null);
            $location = $jobApplication->vacancy->location;
            $date = Carbon::parse($jobApplication->created_at)->diffForHumans();

            return [
                'vacancy_id' => $jobApplication->vacancy->id,
                'job_title' => $jobApplication->vacancy->description,
                'status' => $jobApplication->status,
                'publisher_name' => $publisherName,
                'publisher_photo' => $publisherPhoto,
                'location' => $location,
                'date' => $date,
            ];
        });

        return $this->apiResponse('success', $formattedJobApplications);
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

<?php

namespace App\Repository\Models;



use App\Models\Jobs_Request;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;

class Jobs_RequestRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Jobs_Request::class);
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
}

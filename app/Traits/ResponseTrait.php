<?php

namespace App\Traits;

use App\Models\Advice;
use App\Models\Jops_category;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait ResponseTrait
{
    public function apiResponse($message=null,$data=null,$status=true,$statuscode=200){

        return response()->json([
            'status'=>$status,
            'message' => $message,
            'data'=> $data
        ], $statuscode);
    }

    public function formatVacancyResponse($vacancy)
    {
        $user = $vacancy->user;
        $section = $vacancy->section;
        $category = Jops_category::where('id',$section->jops_category_id)->first()->category;


        return [
            'company_name' => $user ? ($user->role == 2 && $user->company ? $user->company->company_name : $user->name) : null,
            'section' => $section ? $section->section : null,
            'category' => $category ??  null, // Assuming the category name field is 'category_name'
            'vacancy_id' => $vacancy->id,
            'user_id' => $vacancy->user_id,
            'description' => $vacancy->description,
            'vacancy_image' => $vacancy->image,
            'publisher_photo' => $user && $user->role == 1 && $user->employee && $user->employee->image ? '/Employees/' . $user->employee->image->filename : ($user && $user->role == 2 && $user->company ? $user->company->Commercial_Record : null),
            'job_type' => $vacancy->job_type,
            'status' => $vacancy->status,
            'requirements' => $vacancy->requirements,
            'salary_range' => $vacancy->salary_range,
            'application_deadline' => $vacancy->application_deadline,
            'location' => $vacancy->location,
        ];
    }

    public function formatResponses($advices)
    {
        $authUserId = Auth::id();

        return $advices->map(function ($advice) use ($authUserId) {
            $user = $advice->user;
            $isCompany = $user->role == 2;
            $company = $user->company;
            $employee = $user->employee;
            $authRequest = $user->auth_request;

            return [
                'id' => $advice->id,
                'user_id' => $user->id,
                'name' => $isCompany ? $company->company_name : $user->name,
                'image' => $isCompany && $company ? $company->Commercial_Record : ($employee && $employee->image ? '/Employees/' . $employee->image->filename : null),
                'is_auth' => $authRequest && $authRequest->status == 'accepted',
                'time' => Carbon::parse($advice->created_at)->diffForHumans(),
                'likes_count' => $advice->likes()->count(),
                'content' => $advice->content,
                'is_mine' => $advice->user_id == $authUserId,
                'is_liked' => $advice->likes()->where('user_id', $authUserId)->exists(),
            ];
        });
    }

    public function formatQuestionResponse($questions)
    {
        $authUserId = Auth::id();

        return $questions->map(function ($advice) use ($authUserId) {
            $user = $advice->user;
            $isCompany = $user->role == 2;
            $company = $user->company;
            $employee = $user->employee;
            $authRequest = $user->auth_request;

            return [
                'id' => $advice->id,
                'user_id' => $user->id,
                'name' => $isCompany ? $company->company_name : $user->name,
                'image' => $isCompany && $company ? $company->Commercial_Record : ($employee && $employee->image ? '/Employees/' . $employee->image->filename : null),
                'is_auth' => $authRequest && $authRequest->status == 'accepted',
                'time' => Carbon::parse($advice->created_at)->diffForHumans(),
                'likes_count' => $advice->likes()->count(),
                'content' => $advice->content,
                'answers_count' => $advice->answer()->count(),
                'is_mine' => $advice->user_id == $authUserId,
                'is_liked' => $advice->likes()->where('user_id', $authUserId)->exists(),
            ];
        });
    }

    public function formatAnnouncementsResponse($announcements)
    {

        return $announcements->map(function ($announcement) {
            $user = $announcement->user;
            $isCompany = $user->role == 2;
            $company = $user->company;
            $authRequest = $user->auth_request;

            return [
                'id' => $announcement->id,
                'company_name' => $company->company_name,
                'company_photo' => $company ? $company->Commercial_Record : null,
                'duration'=>$announcement->duration,
                'is_auth' => $authRequest && $authRequest->status == 'accepted',
                'company_email' => $company->contact_email,
                'title' => $announcement->title,
                'type' => $announcement->type,
                'start_date' => $announcement->start_date,
                'days' => $announcement->days,
                'time' => $announcement->time,
                'price' => $announcement->price,
                'created_at' => Carbon::parse($announcement->created_at)->diffForHumans(),
            ];
        });
    }

    public function formatApplicationsResponse($applications){
        return $applications->map(function ($application) {
            $user = $application->user;
            $employee = $user->employee;
            $employeeImage = $employee && $employee->image ? '/Employees/' . $employee->image->filename : null;

            return [
                'id'=>$application->id,
                'user_id'=>$user->id,
                'name' => $user->name,
                'image' => $employeeImage,
                'application_date' => $application->created_at->diffForHumans(),
            ];
        });

    }

    public function formatProfileResponse($user)
    {
        $user->load([
            'employee.image',
            'employee.video',
            'employee.skills',
            'address',

        ]);


        $user['points'] = $user->answers->count();

        $advices = Advice::where('user_id',$user->id)->get();

        $formattedAdvices = $this->formatResponses($advices);

        $user['advices'] = $formattedAdvices;

        $user['points'] = $user->answers->count();

        unset($user->answers);


        return $user;

    }

}

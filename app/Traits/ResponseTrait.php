<?php

namespace App\Traits;

use App\Models\Jops_category;
use Carbon\Carbon;

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

    public function formatResponse($advice)
    {
        $user = $advice->user;
        $isCompany = $user->role == 2;
        $company = $user->company;
        $employee = $user->employee;
        $authRequest = $user->auth_request;

        return [
            'name' => $isCompany ? $company->company_name : $user->name,
            'image' => $isCompany && $company ? $company->Commercial_Record : ($employee && $employee->image ? '/Employees/' . $employee->image->filename : null),
            'is_auth' => $authRequest && $authRequest->status == 'accepted',
            'time' => Carbon::parse($advice->created_at)->diffForHumans(),
            'likes_count' => $advice->likes()->count(),
            'content' => $advice->content,
        ];
    }

    public function formatResponses($advices)
    {
        return $advices->map(function ($advice) {
            return $this->formatResponse($advice);
        });
    }

    public function formatQuestionResponse($questions){
        return $questions->map(function ($advice) {
            $user = $advice->user;
            $isCompany = $user->role == 2;
            $company = $user->company;
            $employee = $user->employee;
            $authRequest = $user->auth_request;

            return [
                'name' => $isCompany ? $company->company_name : $user->name,
                'image' => $isCompany && $company ? $company->Commercial_Record : ($employee && $employee->image ? '/Employees/' . $employee->image->filename : null),
                'is_auth' => $authRequest && $authRequest->status == 'accepted',
                'time' => Carbon::parse($advice->created_at)->diffForHumans(),
                'likes_count' => $advice->likes()->count(),
                'content' => $advice->content,
                'answers_count'=>$advice->answer()->count(),
            ];
        });
    }

}

<?php

namespace App\Traits;

trait ResponseTrait
{
    public function apiResponse($message=null,$data=null,$status=true,$statuscode=200){

        return response()->json([
            'status'=>$status,
            'message' => $message,
            'data'=> $data
        ], $statuscode);
    }

    protected function formatVacancyResponse($vacancy)
    {
        $user = $vacancy->user;
        return [
            'company_name' => $user ? ($user->role == 2 && $user->company ? $user->company->company_name : $user->name) : null,
            'section' => $vacancy->section ? $vacancy->section->section : null,
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

}

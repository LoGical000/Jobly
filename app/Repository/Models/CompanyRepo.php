<?php

namespace App\Repository\Models;

use App\Models\Address;
use App\Models\Company;
use App\Class\HelperFunction;
use App\Models\User;
use App\Repository\Reapository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class CompanyRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Company::class);
    }

    public function index(): Response
    {
        $data = Company::with(['user.address'])->first();
        return response()->json([
            'data' => $data,
        ]);
    }

    public function create(array $data): Response
    {
        $mappedData = [
            'Date_of_Establishment' => $data['Date_of_Establishment'],
            'employe_number' => $data['employe_number'],
            'Commercial_Record' => $data['Commercial_Record'],
            'company_name' => $data['company_name'],
            'contact_phone' =>  $data['contact_phone'],
            'industry' => $data['industry'],
            'company_description' => $data['company_description'],
            'company_website' => $data['company_website'],
            'contact_email' => $data['contact_email'],
            'contact_person' => $data['contact_person'],
            'user_id' => auth()->user()->id,
        ];

        $createdUser = Company::create($mappedData);

        if (!$createdUser) {
            return response()->json([
                'message' => 'Failed to create user',
            ], 400);
        }

        return response()->json([
            'data' => $createdUser,
        ]);
    }

    public function index_1(int $id): Response
    {
        $vacancies = User::with(['vacancy.section', 'vacancy.location'])->findOrFail($id);


        $vacancies = $vacancies->vacancy->map(function ($vacancy) use ($vacancies) {
            return [
                'company_name' => $vacancies->company->company_name,
                'section' => $vacancy->section->section,
                'vacancy_id' => $vacancy->id,
                'user_id' => $vacancy->user_id,
                // 'county' => $user->location->county,
                // 'city' => $user->location->city,
                // 'Governorate' => $user->location->Governorate,
                // 'vacancy' => [
                // 'jops_section_id' => $vacancy->jops_section_id,
                'description' => $vacancy->description,
                'vacancy_image' => $vacancy->image,
                'job_type' => $vacancy->job_type,
                'status' => $vacancy->status,
                'requirements' => $vacancy->requirements,
                'salary_range' => $vacancy->salary_range,
                'application_deadline' => $vacancy->application_deadline,
            ];
        });

        return response()->json([
            'data' => $vacancies,
        ]);
    }

    public function getCompanies()
    {
        $companies = Company::all()->map(function ($company) {
            return [
                'company_name' => $company->company_name,
                'company_image' => $company->Commercial_Record,
            ];
        });

        return $this->apiResponse('success', $companies);
    }

    public function getCompanyInfo($id){
       $company =  Company::where('id',$id)->with('ratings','user')->first();
       $company->address = $company->user->address;
       unset($company->user);
       return $this->apiResponse('success',$company);
    }
}

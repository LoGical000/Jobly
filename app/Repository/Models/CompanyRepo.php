<?php

namespace App\Repository\Models;

use App\Models\Address;
use App\Models\Company;
use App\Class\HelperFunction;
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
}

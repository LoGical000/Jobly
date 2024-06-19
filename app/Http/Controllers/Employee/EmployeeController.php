<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Repository\Models\EmployeeRepo;

class EmployeeController extends Controller
{
    private $EmployeeRepository;

    public function __construct(EmployeeRepo $EmployeeRepository)
    {
        $this->EmployeeRepository = $EmployeeRepository;
    }

    public function create(CreateEmployeeRequest $request)
    {
        return $this->EmployeeRepository->store($request);

    }

    public function update(UpdateEmployeeRequest $request)
    {
        return $this->EmployeeRepository->edit($request);

    }

    public function uploadVideo(Request $request)
    {
        return $this->EmployeeRepository->uploadVideo($request);

    }



}

<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\UploadCVRequest;
use App\Http\Requests\UploadVideoRequest;
use App\Models\Employee;
use App\Traits\ResponseTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use App\Repository\Models\EmployeeRepo;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    use ResponseTrait;
    private $EmployeeRepository;

    public function __construct(EmployeeRepo $EmployeeRepository)
    {
        $this->EmployeeRepository = $EmployeeRepository;
    }

    public function create(CreateEmployeeRequest $request)
    {
        return $this->EmployeeRepository->store($request);

    }

    public function show(){
        return $this->EmployeeRepository->showProfile();
    }

    public function update(UpdateEmployeeRequest $request)
    {
        return $this->EmployeeRepository->edit($request);

    }

    public function uploadCV(UploadCVRequest $request){
        return $this->EmployeeRepository->uploadCV($request);

    }

    public function uploadVideo(UploadVideoRequest $request)
    {
        return $this->EmployeeRepository->uploadVideo($request);
    }

    public function profile($id)
    {
        return $this->EmployeeRepository->profile($id);
    }



}

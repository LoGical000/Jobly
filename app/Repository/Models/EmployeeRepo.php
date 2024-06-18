<?php

namespace App\Repository\Models;

use App\Models\Employee;
use App\Repository\Base;
use App\Traits\ResponseTrait;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;

class EmployeeRepo extends Reapository
{
    use UploadTrait;
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(Employee::class);
    }

    public function store($request){
        $Data = [
            'user_id' => Auth::id(),
            //'first_name' => $request->first_name,
            //'last_name' => $request->last_name,
            'age' => $request->age,
            'resume' => $request->resume,
            'experience' => $request->experience,
            'education' => $request->education,
            'portfolio' =>  $request->portfolio,
            'phone_number' => $request->phone_number,
            'work_status' => $request->work_status,
            'graduation_status' => $request->graduation_status,

        ];

        $Employee = Employee::create($Data);

        if (!$Employee)
            return $this->apiResponse('Failed to create Employee',null,false);

        return $this->apiResponse('Employee created successfully',$Employee);

        //$this->UploadImage($request,'photo','doctors','upload_image',$doctor->id,'App\Models\Doctor');


    }
}

<?php

namespace App\Repository\Models;

use App\Models\Employee;
use App\Models\Image;
use App\Repository\Base;
use App\Traits\ResponseTrait;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

        $employee = Employee::create($Data);



        if (!$employee)
            return $this->apiResponse('Failed to create Employee',null,false);

        if ($request->has('photo'))
            $this->UploadImage($request,'photo','Employees','upload_image',$employee->id,'App\Models\Employee');

        $employee->load('image');


        return $this->apiResponse('Employee created successfully',$employee);




    }

    public function edit($request)
    {
        try {

            $employee = Employee::where('user_id', Auth::id())->first();
            $updateData = [];


            if ($request->has('age'))
                $updateData['age'] = $request->age;

            if ($request->has('resume'))
                $updateData['resume'] = $request->resume;

            if ($request->has('experience'))
                $updateData['experience'] = $request->experience;

            if ($request->has('education'))
                $updateData['education'] = $request->education;

            if ($request->has('portfolio'))
                $updateData['portfolio'] = $request->portfolio;

            if ($request->has('phone_number'))
                $updateData['phone_number'] = $request->phone_number;

            if ($request->has('work_status'))
                $updateData['work_status'] = $request->work_status;

            if ($request->has('graduation_status'))
                $updateData['graduation_status'] = $request->graduation_status;

            $employee->update($updateData);

            if ($request->has('photo')){
                if($employee->image){
                    $employee->image->delete();
                }
            $this->UploadImage($request,'photo','Employees','upload_image',$employee->id,'App\Models\Employee');

            }

            $employee->load('image');



            return $this->apiResponse('Employee updated successfully', $employee);
        } catch (\Exception $e) {

            return $this->apiResponse('Failed to update Employee: ' . $e->getMessage(), null, false);
        }

    }
}

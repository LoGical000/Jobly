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
use Symfony\Component\HttpFoundation\Response;

class EmployeeRepo extends Reapository
{
    use UploadTrait;
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(Employee::class);
    }

    public function store($request){
        $validatedData = $request->validated();
        $Data = collect($validatedData)->except('photo')->toArray();
        $Data['user_id'] = Auth::id();

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


            if ($request->has('date_of_birth'))
                $updateData['date_of_birth'] = $request->date_of_birth;

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
                    $filename = $employee->image->filename;
                    $this->Delete_Image('upload_image','Employees/' . $filename,$filename);
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

    public function showProfile(){
        $user = Auth::user();
        $user->load([
            'employee.image',
            'employee.video',
            'employee.skills',
            'address',
        ]);
        return $this->apiResponse('success',$user);
    }

    public function uploadCV($request){
        $employee  = Employee::where('user_id', Auth::id())->first();

        if ($employee->cv) {
            $this->Delete_file('upload_file', 'CVs/' . $employee->cv);
        }

        $file = $request->file('cv');
        $name = \Str::slug($request->input('name'));
        $filename = time() . '-' .$name.  '.' . $file->getClientOriginalExtension();

        $employee->cv = $filename;
        $employee->save();

        $this->UploadPDF($request,'cv','CVs','upload_file',$filename);

        return $this->apiResponse('success',$employee);
    }

    public function uploadVideo($request){
        $employee = Employee::where('user_id', Auth::id())->first();
        if ($employee->video){
            $filename = $employee->video->filename;
            $this->Delete_Video('upload_video','videos/' . $filename,$filename);
            $employee->video->delete();

        }
        $this->UploadVid($request,'video','videos','upload_video',$employee->id,'App\Models\Employee');
        $employee->load('video');
        return $this->apiResponse('success',$employee);


    }
}

<?php

namespace App\Repository\Models;

use App\Repository\Reapository;
use App\Models\Vacancy;
use App\Traits\UploadTrait;
use App\Class\HelperFunction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class VacancyRepo extends Reapository
{
    use UploadTrait;

    public function __construct()
    {
        parent::__construct(Vacancy::class);
    }

    public function create(array $atter): Response
    {
        $atter['user_id'] = auth()->user()->id;
        $vacancy = Vacancy::create($atter);
        return response()->json([
            'data' => $vacancy,
        ]);
    }

    public function create_app($request) {
        $validatedData = $request->validated();
        $Data = collect($validatedData)->except('image')->toArray();
        $Data['user_id'] = Auth::id();
        $vacancy = Vacancy::create($Data);

        if ($request->has('image')) {
            $helper = new HelperFunction();
            $image = $helper->storeImage($request->image);
            $vacancy->image = $image;
            $vacancy->save();
        }

        return $this->apiResponse('success', $vacancy);
    }

    public function getAllJobs(){
        $vacancies = Vacancy::with('location')->get();

        foreach ($vacancies as $vacancy) {
            $user = $vacancy->user;
            //The publisher is a company
            if ($user->role == 2) {
                $vacancy->name = $user->Company->company_name;
                $vacancy->publisher_photo  = $user->Company->Commercial_Record;
            }
            //The publisher is an employee
            if ($user->role == 1) {
                $vacancy->name = $user->name;
                $vacancy->publisher_photo  = 'Employees/' . $user->employee->image->filename;
            }
        unset($vacancy->user);
        }


        return $this->apiResponse('success',$vacancies);
    }
}

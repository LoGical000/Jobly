<?php

namespace App\Repository\Models;

use App\Repository\Reapository;
use App\Models\Vacancy;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
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

    public function create_app($request){
        $validatedData = $request->validated();
        $Data = collect($validatedData)->except('image')->toArray();
        $Data['user_id'] = Auth::id();
        $vacancy = Vacancy::create($Data);

        if($request->has('image')){
            $this->UploadImage($request,'image','Vacancies','upload_image',$vacancy->id,'App\Models\Vacancy');

        }
     return $this->apiResponse('success',$vacancy);
    }
}

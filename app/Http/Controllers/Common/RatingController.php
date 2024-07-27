<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Http\Requests\RatingRequest;
use App\Repository\Models\RatingRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    private $RatingRepository;

    public function __construct(RatingRepo $RatingRepository)
    {
        $this->RatingRepository = $RatingRepository;
    }

    public function create(RatingRequest $request){
        $Data = $request->validated();
        $Data['employee_id'] = Auth::user()->employee->id;
        return $this->RatingRepository->create($Data);


    }

    public function getRatingsForCompany($id){
        return $this->RatingRepository->getRatingsForCompany($id);
    }
}

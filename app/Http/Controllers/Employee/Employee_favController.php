<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Repository\Models\Employee_favRepo;
use Illuminate\Http\Request;


class Employee_favController extends Controller
{
    private $Employee_favRepository;

    public function __construct(Employee_favRepo $Employee_favRepository)
    {
        $this->Employee_favRepository = $Employee_favRepository;
    }

    public function create(Request $request){
        return $this->Employee_favRepository->store($request);
    }

    public function show(){
        return $this->Employee_favRepository->showFav();
    }
}

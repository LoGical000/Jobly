<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSkillRequest;
use App\Models\Employee;
use App\Repository\Models\SkillsRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkillController extends Controller
{
    private $SkillRepository;

    public function __construct(SkillsRepo $SkillRepository)
    {
        $this->SkillRepository = $SkillRepository;
    }

    public function create(CreateSkillRequest $request){
        $Data = $request->validated();
        $Data['employee_id'] = Employee::where('user_id', Auth::id())->first()->id;
        return $this->SkillRepository->create($Data);
    }

    public function show(){
        return $this->SkillRepository->showSkill();
    }

}

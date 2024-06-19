<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSkillRequest;
use App\Repository\Models\SkillsRepo;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    private $SkillRepository;

    public function __construct(SkillsRepo $SkillRepository)
    {
        $this->SkillRepository = $SkillRepository;
    }

    public function create(CreateSkillRequest $request){
        return $this->SkillRepository->store($request);
    }

    public function show(){
        return $this->SkillRepository->showSkill();
    }

}

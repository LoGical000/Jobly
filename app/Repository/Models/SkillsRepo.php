<?php

namespace App\Repository\Models;

use App\Models\Employee;
use App\Repository\Reapository;
use App\Models\Skill;
use App\Traits\ResponseTrait;
use App\Traits\UploadTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class SkillsRepo extends Reapository
{
    use UploadTrait;
    use ResponseTrait;
    public function __construct()
    {
        parent::__construct(Skill::class);
    }

    public function showSkill(){
        $employee_id = Employee::where('user_id', Auth::id())->first()->id;
        $skill = Skill::where('employee_id',$employee_id)->get();
        return $this->apiResponse('success',$skill);
    }


}

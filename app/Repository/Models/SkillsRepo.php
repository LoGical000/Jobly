<?php

namespace App\Repository\Models;

use App\Repository\Reapository;
use App\Models\Skills;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class SkillsRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Skills::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Skills::all();
    }
}

<?php

namespace App\Repository\Models;

use App\Repository\Reapository;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class VacancyRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Vacancy::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Vacancy::all();
    }
}

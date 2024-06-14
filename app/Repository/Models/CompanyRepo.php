<?php

namespace App\Repository;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class CompanyRepo extends Repository
{
    public function __construct()
    {
        parent::__construct(Company::class);
    }

    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Company::all();
    }
}

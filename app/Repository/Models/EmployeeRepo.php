<?php

namespace App\Repository;

use App\Models\Employee;
use App\Repository\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class EmployeeRepo extends Repository
{
    public function __construct()
    {
        parent::__construct(Employee::class);
    }
    

    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Employee::all();
    }
}

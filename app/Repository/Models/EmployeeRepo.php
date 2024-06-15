<?php

namespace App\Repository\Models;

use App\Models\Employee;
use App\Repository\Base;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class EmployeeRepo extends Reapository
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

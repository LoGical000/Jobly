<?php

namespace App\Repository\Models;



use App\Models\employee_fav;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class employee_favRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(employee_fav::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return employee_fav::all();
    }
}

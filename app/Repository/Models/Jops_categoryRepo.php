<?php

namespace App\Repository\Models;



use App\Models\Jops_category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class Jops_categoryRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Jops_category::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    // public function index(): Collection
    // {
    //     return Jops_category::all();
    // }
}

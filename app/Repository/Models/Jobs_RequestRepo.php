<?php

namespace App\Repository\Models;



use App\Models\Jobs_Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class Jobs_RequestRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Jobs_Request::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Jobs_Request::all();
    }
}

<?php

namespace App\Repository\Models;



use App\Models\Location;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class LocationRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Location::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Location::all();
    }
}

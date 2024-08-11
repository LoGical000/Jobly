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

    public function getCities(){
        $cities = Location::all();
        return $this->apiResponse('success',$cities);
    }



}

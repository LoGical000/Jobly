<?php

namespace App\Repository\Models;


use App\Models\Rating;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;
class RatingRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Rating::class);
    }

    public function getRatingsForCompany($id){
       $ratings =  Rating::where('company_id',$id)->get();
       return $this->apiResponse('success',$ratings);
    }

}

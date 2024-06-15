<?php

namespace App\Repository\Models;



use App\Models\Like;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class LikeRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Like::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Like::all();
    }
}

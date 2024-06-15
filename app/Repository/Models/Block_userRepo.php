<?php

namespace App\Repository\Models;


use App\Models\Block_user;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class Block_userRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Block_user::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Block_user::all();
    }
}

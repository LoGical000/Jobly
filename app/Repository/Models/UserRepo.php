<?php

namespace App\Repository;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class UserRepo extends Repository
{
    public function __construct()
    {
        parent::__construct(User::class);
    }
    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return User::all();
    }
}

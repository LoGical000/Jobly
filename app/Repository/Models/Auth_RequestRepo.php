<?php

namespace App\Repository\Models;


use App\Models\Auth_Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class Auth_RequestRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Auth_Request::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Auth_Request::all();
    }
}

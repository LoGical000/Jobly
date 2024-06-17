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
}

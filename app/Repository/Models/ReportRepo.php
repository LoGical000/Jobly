<?php

namespace App\Repository\Models;

use App\Models\Rating;
use App\Models\Report;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class ReportRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Report::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Report::all();
    }
}

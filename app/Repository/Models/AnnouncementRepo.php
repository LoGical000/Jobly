<?php

namespace App\Repository\Models;

use App\Models\Announcement;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class AnnouncementRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Announcement::class);
    }


    // just ex omar to see can it override the funciton ? don't wory 
    public function index(): Collection
    {
        return Announcement::all();
    }
}

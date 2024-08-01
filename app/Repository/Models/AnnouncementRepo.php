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

}

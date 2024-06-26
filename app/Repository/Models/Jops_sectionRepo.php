<?php

namespace App\Repository\Models;



use App\Models\Jops_section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class Jops_sectionRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Jops_section::class);
    }

}

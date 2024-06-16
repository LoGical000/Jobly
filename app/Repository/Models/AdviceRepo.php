<?php

namespace App\Repository\Models;

use App\Models\Address;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Reapository;

class AddressRepo extends Reapository
{
    public function __construct()
    {
        parent::__construct(Address::class);
    }
}

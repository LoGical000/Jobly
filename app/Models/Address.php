<?php

namespace App\Models;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'county',
        'city',
        'Governorate',
        'user_id',
    ];

    public function vacancy()
    {
        return $this->belongsTo(User::class);
    }
}

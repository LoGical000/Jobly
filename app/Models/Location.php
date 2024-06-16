<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'county',
        'city',
        'Governorate',
        'vacancy_id',
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}

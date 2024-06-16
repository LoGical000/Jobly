<?php

namespace App\Models;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jops_section extends Model
{
    use HasFactory;
    protected $fillable = [
        'section',
        'jops_category_id',
    ];

    public function Jops_category()
    {
        return $this->belongsTo(Jops_category::class);
    }


    public function vacancy()
    {
        return $this->hasOne(Vacancy::class);
    }
}

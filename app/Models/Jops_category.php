<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jops_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
    ];

    public function Jops_section()
    {
        return $this->hasMany(Jops_section::class);
    }
}

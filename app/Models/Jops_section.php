<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_of_birth',
        'resume',
        'experience',
        'education',
        'portfolio',
        'phone_number',
        'work_status',
        'graduation_status',
        'cv'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function video(): MorphOne
    {
        return $this->morphOne(Video::class, 'videoable');
    }
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }


}

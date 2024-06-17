<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jobs_Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'user_id',
        'vacancy_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}

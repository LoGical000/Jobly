<?php

namespace App\Models;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'Date_of_Establishment',
        'employe_number',
        'Commercial_Record',
        'company_name',
        'contact_phone',
        'industry',
        'company_description',
        'company_website',
        'contact_person',
        'contact_email',
        'user_id',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

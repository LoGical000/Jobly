<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}

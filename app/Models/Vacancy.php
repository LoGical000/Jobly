<?php

namespace App\Models;

use App\Models\Company;
use App\Models\Address;
use App\Models\Jops_section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory;
    protected $table = 'vacancies';
    protected $fillable = [
        'description',
        'image',
        'job_type',
        'requirements',
        'salary_range',
        'application_deadline',
        'status',
        'jops_section_id',
        'user_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function location()
    {
        return $this->hasOne(Location::class);
    }

    public function section()
    {
        return $this->belongsTo(Jops_section::class);
    }
}

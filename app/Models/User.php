<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Address;
use App\Models\Vacancy;
use App\Models\Jobs_Request;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use  HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'authentication',
        'ban',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function Company()
    {
        return $this->hasOne(Company::class);
    }

    /*
    @ this is for the Address
    */
    public function address()
    {
        return $this->hasOne(Address::class);
    }

    /*
    @ this is for the posting the vacacny "JOBS"
    */
    public function vacancy()
    {
        return $this->hasMany(Vacancy::class);
    }

    /*
    @ this is for the jobs request
    */
    public function jobRequests()
    {
        return $this->hasMany(Jobs_Request::class);
    }
    /*
    @ this is for the jobs request
    */
    public function vacancies()
    {
        return $this->belongsToMany(Vacancy::class, 'jobs__requests');
    }

    public function employee()
    {
        return $this->hasOne(Employee::class);
    }

    public function auth_request()
    {
        return $this->hasOne(Auth_Request::class);
    }

    public function advices(){
        return $this->hasMany(Advice::class);

    }

    public function answers(){
        return $this->hasMany(Answer::class);
    }
}

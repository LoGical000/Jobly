<?php

namespace Database\Seeders;

use App\Models\Auth_Request;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Image;
use App\Models\Skill;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::create([
        'name'=>'Omar Omarain',
        'email' =>'omar@gmail.com',
        'password'=>Hash::make('123456'),
        'role'=> 1,
        'ban'=> 0,
        'authentication' => 1,
            ]);
            echo $user->createToken('secret')->plainTextToken;

        Employee::create([
            'user_id'=>1,
            'date_of_birth'=>'2002-06-05',
            'resume'=>'top level software engineer',
            'experience'=>'3 Years as a back-end developer',
            'education'=>'Damascus University',
            'portfolio'=>'www.omar-omarain.com',
            'phone_number'=>'0951328247',
            'work_status'=>'working',
            'graduation_status'=>'graduated',
        ]);


        Auth_Request::create([
            'user_id'=>1,
            'status'=>'accepted'
        ]);

        User::factory(20)->create()->each(function ($user, $index) {
            // Half are employees
            if ($index < 10) {
                $user->update(['role' => 1]);
                Employee::factory()->create(['user_id' => $user->id]);

                // Create an image for the employee
                Image::factory()->create([
                    'imageable_id' => $user->employee->id,
                    'imageable_type' => 'App\Models\Employee',
                ]);

                // Create 5 skills for each employee
                Skill::factory(5)->create(['employee_id' => $user->employee->id]);
            }
            // Half are companies
            else {
                $user->update(['role' => 2]);
                Company::factory()->create(['user_id' => $user->id]);
            }
        });



        $this->call([
            AddressSeeder::class,
            CategorySeeder::class,
            SectionSeeder::class,
            VacancySeeder::class,



        ]);
    }
}

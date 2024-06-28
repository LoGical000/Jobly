<?php

namespace Database\Seeders;

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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
        'name'=>'Omar Omarain',
        'email' =>'omar@gmail.com',
        'password'=>Hash::make('123456'),
        'role'=> 1,
        'ban'=> 0,
        'authentication' => 1,
            ]);


        $this->call([
            CategorySeeder::class,
            SectionSeeder::class,
            EmployeeSeeder::class,
            ImageSeeder::class,
            SkillSeeder::class,

        ]);
    }
}

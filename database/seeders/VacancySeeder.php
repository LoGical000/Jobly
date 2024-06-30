<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        // Create one vacancy for each user
        $users->each(function ($user) {
            Vacancy::factory()->create(['user_id' => $user->id]);
        });
    }
}

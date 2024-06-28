<?php

namespace Database\Seeders;

use App\Models\Employee;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Employee::factory()->count(1)->create();
    }
}

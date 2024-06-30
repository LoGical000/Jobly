<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        // Create an image for each employee
        foreach ($employees as $employee) {
            Image::factory()->create([
                'imageable_id' => $employee->id,
                'imageable_type' => Employee::class,
            ]);
        }
    }
}

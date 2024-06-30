<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $schools = [
            'Damascus University',
            'Aleppo University',
            'Tishreen University',
            'Al-Baath University',
            'Private University of Science and Arts',
        ];
        $workStatuses = ['working', 'student', 'not working'];
        $graduationStatuses = ['graduated', 'Not graduated'];

        return [
            'user_id' => User::factory(),
            'date_of_birth' => $this->faker->date('Y-m-d', '2020-06-05'),
            'resume' => $this->faker->text,
            'experience' => $this->faker->text(50),
            'education' => $this->faker->randomElement($schools),
            'portfolio' => $this->faker->url,
            'phone_number' => $this->faker->phoneNumber,
            'work_status' => $this->faker->randomElement($workStatuses),
            'graduation_status' => $this->faker->randomElement($graduationStatuses),
        ];
    }
}

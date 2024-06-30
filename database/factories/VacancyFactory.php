<?php

namespace Database\Factories;

use App\Models\Jops_section;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vacancy>
 */
class VacancyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $jobTypes = ["full_time", "part_time", "remotely"];
        $statuses = ["closed", "open"];
        $jopsSectionId = Jops_section::inRandomOrder()->first()->id;
        return [
            'jops_section_id' => $jopsSectionId, // This assumes you have a factory for Jops_section
            'user_id' => User::factory(), // Will be overridden in seeder
            'description' => $this->faker->sentence,
            'image' => null, // Or you can use $this->faker->imageUrl if you want random images
            'job_type' => $this->faker->randomElement($jobTypes),
            'status' => $this->faker->randomElement($statuses),
            'requirements' => $this->faker->paragraph,
            'salary_range' => $this->faker->numberBetween(30000, 100000) . ' USD',
            'application_deadline' => $this->faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }
}

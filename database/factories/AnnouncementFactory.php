<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Announcement>
 */
class AnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyUserIds = User::where('role', 2)->pluck('id')->toArray();
        $startHour = $this->faker->numberBetween(1, 11);
        $endHour = $this->faker->numberBetween($startHour + 1, 12);
        return [
            'user_id' => $this->faker->randomElement($companyUserIds),
            'title' => $this->faker->sentence,
            'type' => $this->faker->randomElement(['course', 'internship']),
            'start_date' => $this->faker->date(),
            'days' => implode(', ', $this->faker->randomElements(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], rand(1, 5))),
            'time' => "$startHour - $endHour",
            'price' => $this->faker->numberBetween(100000, 2500000),
        ];
    }
}

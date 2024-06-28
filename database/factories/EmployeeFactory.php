<?php

namespace Database\Factories;

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
        return [
            'user_id'=>1,
            'date_of_birth'=>'2002-06-05',
            'resume'=>$this->faker->text,
            'experience'=>$this->faker->text(50),
            'education'=>'Damascus University',
            'portfolio'=>$this->faker->url,
            'phone_number'=>'0951328247',
            'work_status'=>'working',
            'graduation_status'=>'graduated',
        ];
    }
}

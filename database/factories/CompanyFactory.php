<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Will be overridden in seeder
            'Date_of_Establishment' => $this->faker->date('Y-m-d'),
            'employe_number' => $this->faker->numberBetween(10, 500),
            'Commercial_Record' => 'company.jpg',
            'company_name' => $this->faker->company,
            'contact_phone' => $this->faker->phoneNumber,
            'industry' => $this->faker->word,
            'company_description' => $this->faker->paragraph,
            'company_website' => $this->faker->url,
            'contact_email' => $this->faker->companyEmail,
            'contact_person' => $this->faker->name,
        ];
    }
}

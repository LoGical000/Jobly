<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skills = [
            'Project Management', 'Data Analysis', 'Software Development', 'Digital Marketing',
            'Graphic Design', 'CopyWriting', 'SEO', 'Sales', 'Customer Service', 'Accounting',
            'Public Speaking', 'Web Development', 'Networking', 'Leadership', 'Team Management',
            'Time Management', 'Microsoft Office', 'JavaScript', 'PHP', 'Python', 'Java', 'C++',
            'Ruby on Rails', 'React', 'Vue.js', 'Angular', 'SQL', 'NoSQL', 'DevOps', 'Machine Learning',
            'Artificial Intelligence', 'Cloud Computing', 'CyberSecurity', 'Blockchain', 'UI/UX Design'
        ];

        return [
            'employee_id' => null,
            'skill' => $this->faker->randomElement($skills),
        ];
    }
}

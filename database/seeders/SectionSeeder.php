<?php

namespace Database\Seeders;

use App\Models\Jops_section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /* IT */
        Jops_section::create([
            'section' => 'FrontEnd',
            'jops_category_id' => 1,
        ]);
        Jops_section::create([
            'section' => 'BackEnd',
            'jops_category_id' => 1,
        ]);
        Jops_section::create([
            'section' => 'Data Analyst',
            'jops_category_id' => 1,
        ]);

        /* Medical*/

        Jops_section::create([
            'section' => 'Nerves',
            'jops_category_id' => 2,
        ]);
        Jops_section::create([
            'section' => 'Hearty',
            'jops_category_id' => 2,
        ]);
        Jops_section::create([
            'section' => 'Eyes',
            'jops_category_id' => 2,
        ]);
    }
}

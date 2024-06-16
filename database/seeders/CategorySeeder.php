<?php

namespace Database\Seeders;

use App\Models\Jops_category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('jops_categories')->insert([
        //     'category' => 'IT & Technological',
        // ]);
        // DB::table('jops_categories')->insert([
        //     'category' => 'Educational',
        // ]);
        // DB::table('jops_categories')->insert([

        // ]);
        // DB::table('jops_categories')->insert([
        //     'category' => 'Trade and economy',
        // ]);
        // DB::table('jops_categories')->insert([
        //     'category' => 'Others',
        // ]);
        Jops_category::create([
            'category' => 'IT & Technological',
        ]);
        Jops_category::create([
            'category' => 'Medical',
        ]);
        Jops_category::create([
            'category' => 'Educational',
        ]);
        Jops_category::create([
            'category' => 'Trade and economy',
        ]);
    }
}

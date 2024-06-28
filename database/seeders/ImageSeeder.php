<?php

namespace Database\Seeders;

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
        $Image = new Image();
        $Image->filename = 'photo.jpg';
        $Image->imageable_id = 1;
        $Image->imageable_type = 'App\Models\Employee';
        $Image->save();
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('homes')->insert([
            [
                'image_title_en' => 'Home Page',
                'image_title_ar' => 'الصفحة الرئيسية',
                'image_path' => 'storage/images/2024_04_28_105409_1714301649.png',
                'sort_order' => 1,
                'created_at' => '2024-04-28 16:12:16',
                'updated_at' => null,
            ],
            [
                'image_title_en' => 'Golden Marble',
                'image_title_ar' => 'رخام ذهبي',
                'image_path' => 'storage/images/2024_04_28_105453_1714301693.png',
                'sort_order' => 2,
                'created_at' => '2024-04-28 10:54:53',
                'updated_at' => '2024-04-28 10:54:53',
            ],
            [
                'image_title_en' => 'White Marble',
                'image_title_ar' => 'رخام أبيض',
                'image_path' => 'storage/images/2024_04_28_105545_1714301745.png',
                'sort_order' => 3,
                'created_at' => '2024-04-28 10:55:45',
                'updated_at' => '2024-04-28 10:55:45',
            ],
        ]);
    }
}

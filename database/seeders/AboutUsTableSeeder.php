<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about_us')->insert([
            [
                'image_path' => 'storage/images/2024_05_02_130249_1714654969.png',
                'content_en' => 'About us content goes here.',
                'content_ar' => 'هنا محتوى الصفحه',

            ],
        ]);
    }
}

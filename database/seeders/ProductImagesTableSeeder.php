<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_images')->insert([
            [
                'product_id' => 1,
                'image_path' => 'storage/images/smartphone_662e2563c2e4f.png',
                'created_at' => '2024-04-28 10:30:59',
                'updated_at' => '2024-04-28 10:30:59',
            ],
            [
                'product_id' => 2,
                'image_path' => 'storage/images/carrara_white_662e271068cfb.png',
                'created_at' => '2024-04-28 10:38:08',
                'updated_at' => '2024-04-28 10:38:08',
            ],
            [
                'product_id' => 3,
                'image_path' => 'storage/images/statuarietto_663053d9c39eb.jpg',
                'created_at' => '2024-04-30 02:13:45',
                'updated_at' => '2024-04-30 02:13:45',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDimensionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('product_dimensions')->insert([
            [
                'product_id' => 1,
                'length' => 15.00,
                'width' => 7.00,
                'height' => 0.80,
                'dimension_unit' => 'cm',
                'created_at' => '2024-04-23 11:10:10',
                'updated_at' => '2024-04-23 11:10:10',
            ],
            [
                'product_id' => 2,
                'length' => 20.00,
                'width' => 20.00,
                'height' => 20.00,
                'dimension_unit' => 'cm',
                'created_at' => '2024-04-28 10:38:08',
                'updated_at' => '2024-04-28 10:38:08',
            ],
            [
                'product_id' => 3,
                'length' => 57.00,
                'width' => 23.00,
                'height' => 36.00,
                'dimension_unit' => 'cm',
                'created_at' => '2024-04-28 10:40:53',
                'updated_at' => '2024-04-30 03:08:59',
            ],
        ]);
    }
}

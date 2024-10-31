<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('variants')->insert([
            [
                'product_id' => 1,
                'variant_type_id' => 1,
                'variant_value_en' => 'Black',
                'variant_value_ar' => 'أسود',
            ],
            [
                'product_id' => 1,
                'variant_type_id' => 1,
                'variant_value_en' => 'Gold',
                'variant_value_ar' => 'ذهبي',
            ],
            [
                'product_id' => 2,
                'variant_type_id' => 1,
                'variant_value_en' => 'White',
                'variant_value_ar' => 'أبيض',
            ],
            [
                'product_id' => 2,
                'variant_type_id' => 1,
                'variant_value_en' => 'Beige',
                'variant_value_ar' => 'بيج',
            ],
            [
                'product_id' => 3,
                'variant_type_id' => 1,
                'variant_value_en' => 'Silver',
                'variant_value_ar' => 'فضي',
            ],
            [
                'product_id' => 3,
                'variant_type_id' => 2,
                'variant_value_en' => 'Large',
                'variant_value_ar' => 'كبير',
            ],
        ]);
    }
}

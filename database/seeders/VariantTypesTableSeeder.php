<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('variant_types')->insert([
            ['name_en' => 'Color', 'name_ar' => 'اللون'],
            ['name_en' => 'Size', 'name_ar' => 'الحجم'],
        ]);
    }
}

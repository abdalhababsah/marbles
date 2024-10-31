<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class inventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventories')->insert([
            [
                'product_id' => 1,
                'quantity_available' => 100,
            ],    [
                'product_id' => 2,
                'quantity_available' => 100,
            ],    [
                'product_id' => 3,
                'quantity_available' => 100,
            ],
        ]);
    }
}

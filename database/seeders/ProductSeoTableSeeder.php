<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_seo')->insert([
            [
                'product_id' => 1,
                'meta_title_en' => 'Buy Smartphone Online',
                'meta_title_ar' => 'شراء هاتف ذكي عبر الإنترنت',
                'meta_description_en' => 'Purchase the latest smartphone online at our store.',
                'meta_description_ar' => 'اشترِ أحدث هاتف ذكي عبر الإنترنت في متجرنا.', // Arabic meta description
            ],
        ]);
    }
}

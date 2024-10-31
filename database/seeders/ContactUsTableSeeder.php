<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contact_us')->insert([
            [
                'name' => 'Company Name',
                'email' => 'contact@company.com',
                'number' => '123-456-7890',
                'description' => 'Contact us any time.',
                'seen' => 1,
                'created_at' => '2024-04-09 01:34:53',
                'updated_at' => '2024-04-27 10:05:15',
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'number' => '1234567890',
                'description' => 'This is a test message for the contact us form.',
                'seen' => 1,
                'created_at' => '2024-04-28 11:07:20',
                'updated_at' => '2024-04-28 14:09:49',
            ],
            [
                'name' => 'John Doe',
                'email' => 'johndoe@example.com',
                'number' => '1234567890',
                'description' => 'This is a test message for the contact us form.',
                'seen' => 1,
                'created_at' => '2024-04-28 11:19:10',
                'updated_at' => '2024-04-28 16:28:51',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            RolesPermissionsSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            VariantTypesTableSeeder::class,
            VariantsTableSeeder::class,
            inventoriesTableSeeder::class,
            ProductImagesTableSeeder::class,
            ProductSeoTableSeeder::class,
            AboutUsTableSeeder::class,
            ContactUsTableSeeder::class,
            HomeTableSeeder::class,
            ProductDimensionsTableSeeder::class
        ]);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'name_en' => 'Black Marble',
                'name_ar' => 'رخام أسود',
                'icon_path' => 'storage/images/black_marble_1714301868.png',
                'slug' => 'black-marble',
                'description_en' => 'Marble with a deep black color, known for its unique allure and its ability to add a touch of elegance and luxury to spaces with its dark appearance.',
                'description_ar' => 'رخام ذو لون أسود عميق، يتميز بجاذبيته الفريدة وقوة تحمله للمظاهر الداكنة التي تضيف لمسة من الأناقة والفخامة إلى المساحات التي يُستخدم فيها.',
                'created_at' => '2024-04-28 07:57:48',
                'updated_at' => null,
            ],
            [
                'name_en' => 'White Marble',
                'name_ar' => 'رخام أبيض',
                'icon_path' => 'storage/images/white_marble_1714301884.png',
                'slug' => 'white-marble',
                'description_en' => 'Natural marble with a pure white color, renowned for its classic beauty and ability to bring a bright and refreshing atmosphere to any space it\'s used in.',
                'description_ar' => 'رخام طبيعي ذو لون أبيض نقي، يتميز بجماليته الكلاسيكية وقدرته على إضفاء طابع مشرق ومنعش على الأماكن التي يُستخدم فيها.',
                'created_at' => '2024-04-28 07:58:04',
                'updated_at' => null,
            ],
            [
                'name_en' => 'Gray Marble',
                'name_ar' => 'رخام رمادي',
                'icon_path' => 'storage/images/gray_marble_1714301853.png',
                'slug' => 'gray-marble',
                'description_en' => 'Marble with various shades of gray, distinguished by its diverse tones and patterns, making it suitable for use in a wide range of interior and exterior designs.',
                'description_ar' => 'رخام بلون رمادي متنوع، يتميز بتنوع درجاته وأنماطه، مما يجعله مناسبًا للاستخدام في مجموعة متنوعة من التصاميم الداخلية والخارجية.',
                'created_at' => '2024-04-28 07:47:55',
                'updated_at' => '2024-04-28 08:00:36',
            ],
        ]);
    }
}

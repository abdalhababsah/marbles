<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name_en' => 'Calacatta Gold',
                'name_ar' => 'كالكاتا جولد',
                'slug_en' => 'smartphone',
                'slug_ar' => 'هاتف-ذكي',
                'description_en' => '<p><a href="#" rel="noopener noreferrer" target="_blank" style="color: rgb(255, 0, 0);">Calacatta Gold</a><span style="color: rgb(20, 22, 23);">&nbsp;is a white calcite marble with a timeless aesthetic. It exhibits a sublime off-white base with outlined golden and grey streaks of different thicknesses.</span></p>',
                'description_ar' => '<p>كالكتا جولد هو رخام كالسيت أبيض ذو جمالية خالدة. يُظهر قاعدة بيضاء لامعة مع خطوط ذهبية ورمادية محددة بسماكات مختلفة.</p>',
                'qrcode' => null,
                'category_type' => 'new',
                'category_id' => 3,
                'status' => 'active',
                'created_at' => '2024-04-28 13:43:45',
                'updated_at' => null,
            ],
            [
                'name_en' => 'Carrara White',
                'name_ar' => 'بيانكو كارارا',
                'slug_en' => 'carrara-white',
                'slug_ar' => 'byanko-karara',
                'description_en' => 'Bianco Carrara marble, as its name suggests, comes from the Carrara quarries in the Tosco-Emilian Apennines. Its homogeneous greyish white base is composed of fine, shiny particles. Its veins are grey in color and are distributed over the surface as capillaries. There are different classifications of Bianco Carrara, and its level of whiteness defines each group\r\n\r\nIt is one of the most famous marbles in the world, both today and in the distant past, through the Renaissance and Baroque. Michelangelo Buonarroti used Carrara White marble to sculpt the famous sculpture of David.',
                'description_ar' => 'يأتي رخام بيانكو كارارا، كما يوحي اسمه، من محاجر كارارا في جبال توسكو-إميليان أبينين. تتكون قاعدتها البيضاء الرمادية المتجانسة من جزيئات دقيقة لامعة. عروقها رمادية اللون وتتوزع على السطح على شكل شعيرات دموية. هناك تصنيفات مختلفة لبيانكو كارارا، ومستوى بياضه يحدد كل مجموعة\r\n\r\nوهي واحدة من أشهر الرخامات في العالم، سواء في يومنا هذا أو في الماضي البعيد، خلال عصر النهضة والباروك. استخدم مايكل أنجلو بوناروتي رخام كارارا الأبيض لنحت تمثال داود الشهير.',
                'qrcode' => null,
                'category_type' => 'hot',
                'category_id' => 1,
                'status' => 'inactive',
                'created_at' => '2024-04-28 07:38:08',
                'updated_at' => '2024-04-28 13:10:51',
            ],
            [
                'name_en' => 'Statuarietto',
                'name_ar' => 'ستانتويريتو',
                'slug_en' => 'statuarietto',
                'slug_ar' => 'stantoyryto',
                'description_en' => '<p>Statuarietto is extracted in Carrara as well. It is a unique compact white, medium-fine grain marble. Its white base intermingles shades of pale grey and alborea indigo. The veins present a bluish grey tonality. It is ideal to be used for interior floors and walls, .</p>',
                'description_ar' => '<p>يتم استخراج ستانتويريتو في كارارا أيضًا. إنه رخام فريد من نوعه ذو حبيبات بيضاء متوسطة النعومة. تمزج قاعدته البيضاء بين ظلال اللون الرمادي الباهت والنيلي البوريا. تقدم الأوردة نغمة رمادية مزرقة. إنه مثالي للاستخدام في الأرضيات والجدران الداخلية، بالإضافة إلى أسطح عمل المطبخ.</p>',
                'qrcode' => null,
                'category_type' => 'hot',
                'category_id' => 3,
                'status' => 'inactive',
                'created_at' => '2024-04-28 07:40:53',
                'updated_at' => '2024-04-30 00:08:53',
            ],
        ]);
    }
}

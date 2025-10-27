<?php

namespace Database\Seeders;

use App\Models\product;
use Illuminate\Support\Facades\DB;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        $categories = [
            ['id' => 1, 'name' => 'Skincare', 'description' => 'this for skincare products', 'imagepath' => 'assets\img\skincare.png'],
            ['id' => 2, 'name' => 'Cold&flu', 'description' => 'this for cold and flu products', 'imagepath' => 'assets\img\cold.png'],
            ['id' => 3, 'name' => 'Pain Relief', 'description' => 'this for Pain Relief products', 'imagepath' => 'assets\img\pain.png'],
            ['id' => 4, 'name' => 'Antibiotics', 'description' => 'this for Antibiotic products', 'imagepath' => 'assets\img\anti.png'],
        ];




        DB::table('categories')->insertOrIgnore($categories);




        $product = [
            [ 'name' => 'الغسول (Cleanser)', 'description' => 'الوصف: يستخدم في الخطوة الأولى من روتين العناية لتنظيف البشرة بعمق وإزالة الأتربة، الشوائب، والمكياج', 
            'imagepath' => 'assets/img/cleanser.jpeg','price' => 100, 'amount' => 50,  'category_id' => 1],

            [ 'name' => 'بانادول كولد + فلو داي  (Panadol cold + flu day)', 'description' => 'بانادول كولد + فلو داي مسكن فعال لأعراض الزكام والإنفلونزا، وهو يضم تركيبة لا تسبب النعاس ما يجعله مثالياً للاستخدام خلال النهار.', 
            'imagepath' => 'assets/img/panadol.webp','price' => 60, 'amount' => 30,  'category_id' => 2],

            [ 'name' => 'الباراسيتامول (Paracetamol)', 'description' => 'ينتمي دواء الباراسيتامول Paracetamol إلى فئتي المسكنات وخوافض الحرارة، وهو من الأدوية التي تُستخدم على نطاق واسع في جميع أنحاء العالم. على الرغم ', 
            'imagepath' => 'assets/img/para.jpeg','price' => 70, 'amount' => 40,  'category_id' => 3],

            [ 'name' => 'البينسلين (Penicillin)', 'description' => 'يعالج البنسلين العديد من الأمراض البكتيرية، مثل الخراجات، والالتهابات البكتيرية الجلدية، وأمراض مثل الزهري، والكزاز، وداء لايم.', 
            'imagepath' => 'assets/img/pen.jpeg','price' => 150, 'amount' => 80,  'category_id' => 4],
        ];

                DB::table('products')->insertOrIgnore($product);

    }
}

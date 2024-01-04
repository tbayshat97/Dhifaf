<?php

use App\Enums\SectionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sesctions_rows = [
            ['id' => 1, 'key' => SectionType::Header],
            ['id' => 2, 'key' => SectionType::Footer],
        ];

        DB::table('sections')->insert($sesctions_rows);

        DB::table('sections')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $sections = [
            SectionType::Header =>
            [
                'en' => [
                    'content' => 'Free delivery - On all orders over $60',
                ],
                'ar' => [
                    'content' => 'توصيل مجاني -على كل الطلبات التي تتعدى 60 دولار',
                ]
            ],
            SectionType::Footer =>
             [

                'en' => [
                    'content' => 'orem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat."',
                ],
                'ar' => [
                    'content' => 'حقق أقصى استفادة من حياتك المهنية,حقق أقصى استفادة من حياتك المهنية',
                ]
            ],
        ];

        $section_translations_rows = [
            ['id' => 1, 'section_id' => 1, 'locale' => 'en', 'data' => json_encode($sections[SectionType::Header]['en'])],
            ['id' => 2, 'section_id' => 1, 'locale' => 'ar', 'data' => json_encode($sections[SectionType::Header]['ar'])],
            ['id' => 3, 'section_id' => 2, 'locale' => 'en', 'data' => json_encode($sections[SectionType::Footer]['en'])],
            ['id' => 4, 'section_id' => 2, 'locale' => 'ar', 'data' => json_encode($sections[SectionType::Footer]['ar'])],

        ];

        DB::table('section_translations')->insert($section_translations_rows);

        DB::table('section_translations')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}

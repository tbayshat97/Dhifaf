<?php

use App\Enums\AboutSectionType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sesctions_rows = [
            ['id' => 1, 'key' => AboutSectionType::SectionOne],
            ['id' => 2, 'key' => AboutSectionType::SectionTwo],
            ['id' => 3, 'key' => AboutSectionType::SectionThree],
        ];

        DB::table('about_sections')->insert($sesctions_rows);

        DB::table('about_sections')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $sections = [
            AboutSectionType::SectionOne =>
            [
                'en' => [
                    'head' => 'ABOUT',
                    'title' => 'DHIFAF BAGHDAD',
                    'content' => 'DBC Currently Covers 18 Provinces Of Iraq Through Its 6 Regional Offices Providing Survives To 8,507 Customers Directly And More Than 12,000 Customers Indirectly.',
                    'image' => '/frontend/images/login-img.png'
                ],
                'ar' => [
                    'head' => 'حول ',
                    'title' => 'ضفاف بغداد',
                    'content' => 'مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد',
                    'image' => '/frontend/images/login-img.png'
                ]
            ],
            AboutSectionType::SectionTwo => [
                'en' => [
                    'title' => 'Who WE Are',
                    'content_1' => 'Plans To Expand To 8 Regional Offices By 2021 By Launching DBC New Regional Offices In Major Population Provinces As Mosul 3.2M, Nasiriya 2M And Anbar 1.8M',
                    'content_2' => 'The Plan Is To Provide More Efficient Direct Service To Customers Who Are Currently Served Through Wholesalers Or Our Nearest Regional Offices.',
                    'image' => '/frontend/images/login-img.png'
                ],
                'ar' => [
                    'title' => 'من نحن',
                    'content_1' => 'مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد',
                    'content_2' => 'مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد.',
                    'image' => '/frontend/images/login-img.png'
                ]
            ],
            AboutSectionType::SectionThree =>
            [
                'en' => [
                    'title' => 'WHY CHOOSE US?',
                    'content' => 'Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales dolor nec mattis,Praesent sed ex vel mauris eleifend mollis. Vestibulum dictum sodales ante, ac pulvinar urna sollicitudin in. Suspendisse sodales dolor nec mattis',
                    'image' => '/frontend/images/login-img.png'
                ],
                'ar' => [
                    'title' => 'لماذا نحن ?',
                    'content' => 'مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد,مرحبا بكم في ضفاف بغداد',
                    'image' => '/frontend/images/login-img.png'
                ]
            ],
        ];

        $section_translations_rows = [
            ['id' => 1, 'about_section_id' => 1, 'locale' => 'en', 'data' => json_encode($sections[AboutSectionType::SectionOne]['en'])],
            ['id' => 2, 'about_section_id' => 1, 'locale' => 'ar', 'data' => json_encode($sections[AboutSectionType::SectionOne]['ar'])],
            ['id' => 3, 'about_section_id' => 2, 'locale' => 'en', 'data' => json_encode($sections[AboutSectionType::SectionTwo]['en'])],
            ['id' => 4, 'about_section_id' => 2, 'locale' => 'ar', 'data' => json_encode($sections[AboutSectionType::SectionTwo]['ar'])],
            ['id' => 5, 'about_section_id' => 3, 'locale' => 'en', 'data' => json_encode($sections[AboutSectionType::SectionThree]['en'])],
            ['id' => 6, 'about_section_id' => 3, 'locale' => 'ar', 'data' => json_encode($sections[AboutSectionType::SectionThree]['ar'])],
        ];

        DB::table('about_section_translations')->insert($section_translations_rows);

        DB::table('about_section_translations')->update([
            'created_at' => now(),
            'updated_at' => now()
        ]);

    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsiteSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_sliders_rows = [
            ['id' => 1, 'section_key' => 'main',  'url' => route('admin.dashboard')],
        ];

        DB::table('website_sliders')->insert($website_sliders_rows);

        $website_slider_translations_rows = [
            ['id' => 1, 'website_slider_id' => 1, 'locale' => 'en', 'title' => 'Awaken Your Confidence For A Better Life'],
            ['id' => 2, 'website_slider_id' => 1, 'locale' => 'ar', 'title' => 'Awaken Your Confidence For A Better Life'],
        ];

        DB::table('website_slider_translations')->insert($website_slider_translations_rows);

        DB::table('website_sliders')->update([
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('website_slider_translations')->update([
            'content' => 'Put any text here',
            'action' => 'action text',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

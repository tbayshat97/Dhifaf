<?php

use App\Models\WebsitePage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebsitePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(WebsitePage::class, 6)->create();

        $pages_translations_rows = [
            ['id' => 1, 'website_page_id' => 1, 'locale' => 'en', 'title' => 'Shipping Policy', 'slug' => 'shipping-policy'],
            ['id' => 2, 'website_page_id' => 1, 'locale' => 'ar', 'title' => 'سياسة الشحن', 'slug' => 'سياسة-الشحن'],
            ['id' => 3, 'website_page_id' => 2, 'locale' => 'en', 'title' => 'Privacy Policy', 'slug' => 'privacy-policy'],
            ['id' => 4, 'website_page_id' => 2, 'locale' => 'ar', 'title' => 'سياسة الخصوصيه', 'slug' => 'سياسة-الخصوصيه'],
            ['id' => 5, 'website_page_id' => 3, 'locale' => 'en', 'title' => 'Disclaimer', 'slug' => 'disclaimer'],
            ['id' => 6, 'website_page_id' => 3, 'locale' => 'ar', 'title' => 'إخلاء المسؤولية', 'slug' => 'إخلاء-المسؤولية'],
            ['id' => 7, 'website_page_id' => 4, 'locale' => 'en', 'title' => 'Returns Policy', 'slug' => 'returns-policy'],
            ['id' => 8, 'website_page_id' => 4, 'locale' => 'ar', 'title' => 'سياسة الاسترجاع', 'slug' => 'سياسة-الاسترجاع'],
            ['id' => 9, 'website_page_id' => 5, 'locale' => 'en', 'title' => 'Sitemap', 'slug' => 'sitemap'],
            ['id' => 10, 'website_page_id' => 5, 'locale' => 'ar', 'title' => 'خريطة الموقع', 'slug' => 'خريطة-الموقع'],
            ['id' => 11, 'website_page_id' => 6, 'locale' => 'en', 'title' => 'FAQ', 'slug' => 'faq'],
            ['id' => 12, 'website_page_id' => 6, 'locale' => 'ar', 'title' => 'الاسئلة الاكثر تكرارا', 'slug' => 'الاسئلة الاكثر تكرارا'],
        ];

        DB::table('website_page_translations')->insert($pages_translations_rows);

        DB::table('website_page_translations')->update([
            'content' => 'Put any text here',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

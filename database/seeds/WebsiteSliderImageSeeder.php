<?php

use App\Models\WebsiteSliderImage;
use Illuminate\Database\Seeder;

class WebsiteSliderImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(WebsiteSliderImage::class, 5)->create();
    }
}

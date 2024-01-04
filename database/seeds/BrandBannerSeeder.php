<?php

use App\Models\Brand;
use App\Enums\BrandType;
use App\Models\BrandBanner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class BrandBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // factory(BrandBannerTranslation::class, 10)->create();

        $faker = Faker\Factory::create();

        $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));
        $filepath_brand_banner = public_path('storage/brand-banner');
        if (!File::exists($filepath_brand_banner)) {
            File::makeDirectory($filepath_brand_banner, 0777, true);
        }

        $langs = [
            ['name' => 'english', 'code' => 'en'],
            ['name' => 'arabic', 'code' => 'ar'],
        ];

        $brands = Brand::where('status',BrandType::Luxury)->get();
        foreach ($brands as $brand) {
            $brandBanner = new BrandBanner();
            $brandBanner->brand_id = $brand->id;
            $brandBanner->image = 'brand-banner/' . $faker->image($filepath_brand_banner, 1920, 500, ['technics'], false);

            foreach ($langs as $lang) {
                $brandBanner->translateOrNew($lang['code'])->name = $faker->name;
                $brandBanner->save();
            }
        }

    }
}

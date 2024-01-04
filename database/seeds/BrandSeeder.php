<?php

use Carbon\Carbon;
use App\Models\Brand;
use App\Models\Product;
use App\Enums\BrandType;
use Illuminate\Database\Seeder;
use App\Models\BrandTranslation;
use Illuminate\Support\Facades\File;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(BrandTranslation::class, 10)->create();

        #crating sub brands
        $brands = Brand::whereNull('parent_brand_id')->inRandomOrder()->take(6)->get();
        $langs = [
            ['name' => 'english', 'code' => 'en'],
            ['name' => 'arabic', 'code' => 'ar'],
        ];

        $faker = Faker\Factory::create();
        $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

        $filepath_brand = public_path('storage/brand');
        if (!File::exists($filepath_brand)) {
            File::makeDirectory($filepath_brand, 0777, true);
        }

        $image = 'brand/' . $faker->image($filepath_brand, 720, 1520, ['technics'], false);

        foreach ($brands as $brand) {

            $subBrand = new Brand();
            $subBrand->parent_brand_id = $brand->id;
            $subBrand->image = $image;
            $subBrand->header = $image;
            $subBrand->is_active = true;
            $subBrand->status = BrandType::Normal;
            $subBrand->account_verified_at = Carbon::now();
            $subBrand->save();

            foreach ($langs as $lang) {
                $subBrand->translateOrNew($lang['code'])->name = $faker->name;
                $subBrand->save();
            }

        }
    }
}

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\BrandBanner;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(BrandBanner::class, function (Faker $faker) {
    $filepath_brand = public_path('storage/brand-banner');
    if (!File::exists($filepath_brand)) {
        File::makeDirectory($filepath_brand, 0777, true);
    }
    return [
        'brand_id' => Brand::inRandomOrder()->limit(1)->first()->id,
        'image' => 'brand-banner/' . $faker->image($filepath_brand, 1920, 500, ['technics'], false),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\BrandSlider;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(BrandSlider::class, function (Faker $faker) {
    $filepath_brand = public_path('storage/brand-slider');
    if (!File::exists($filepath_brand)) {
        File::makeDirectory($filepath_brand, 0777, true);
    }

    return [
        'brand_id' => Brand::inRandomOrder()->limit(1)->first()->id,
        'image' => 'brand-slider/' . $faker->image($filepath_brand, 1920, 1080, ['technics'], false),
        'logo' => 'brand-slider/luxury_logo.svg',
    ];
});

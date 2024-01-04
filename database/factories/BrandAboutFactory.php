<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\BrandAbout;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(BrandAbout::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath_banner = public_path('storage/brand-about');
    if (!File::exists($filepath_banner)) {
        File::makeDirectory($filepath_banner, 0777, true);
    }
    return [
        'brand_id' => Brand::all()->random()->id,
        'big_image' => 'brand-about/' . $faker->image($filepath_banner, 790, 945, ['technics'], false),
        'small_image' => 'brand-about/' . $faker->image($filepath_banner, 340, 390, ['technics'], false),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Banner;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(Banner::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath_banner = public_path('storage/banner');
    if (!File::exists($filepath_banner)) {
        File::makeDirectory($filepath_banner, 0777, true);
    }

    return [
        'image' => 'banner/' . $faker->image($filepath_banner, 600, 600, ['technics'], false),
    ];
});

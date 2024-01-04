<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MainSliderImage;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(MainSliderImage::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath = public_path('storage/mainSliderImage');
    if (!File::exists($filepath)) {
        File::makeDirectory($filepath, 0777, true);
    }
    return [
        'main_slider_id' => 1,
        'image' => 'mainSliderImage/' . $faker->image($filepath, 600, 600, ['technics'], false),
    ];
});

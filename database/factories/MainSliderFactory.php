<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MainSlider;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(MainSlider::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath_main_slider = public_path('storage/mainSlider');
    if (!File::exists($filepath_main_slider)) {
        File::makeDirectory($filepath_main_slider, 0777, true);
    }

    return [
        'image' => 'mainSlider/' . $faker->image($filepath_main_slider, 1920, 1080, ['technics'], false),
        'btn_link' => $faker->url, 
    ];
});

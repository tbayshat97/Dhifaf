<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\WebsiteSlider;
use App\Models\WebsiteSliderImage;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(WebsiteSliderImage::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath = public_path('storage/websiteSlider');
    if (!File::exists($filepath)) {
        File::makeDirectory($filepath, 0777, true);
    }

    return [
        'website_slider_id' => WebsiteSlider::inRandomOrder()->limit(1)->first()->id,
        'image' => 'websiteSlider/' . $faker->image($filepath, 600, 600, ['technics'], false)
    ];
});

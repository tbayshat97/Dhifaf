<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\MainSlider;
use App\Models\MainSliderTranslation;
use Faker\Generator as Faker;

$factory->define(MainSliderTranslation::class, function (Faker $faker) {
    return [
        'main_slider_id' => factory(MainSlider::class)->create()->id,
        'locale' => 'en',
        'line_one' => $faker->title,
        'line_two' => $faker->title,
        'line_three' => $faker->title,
        'line_four' => $faker->title,
        'btn_text' => 'Click me',
    ];
});

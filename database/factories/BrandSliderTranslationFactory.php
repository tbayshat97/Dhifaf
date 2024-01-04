<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BrandSlider;
use App\Models\BrandSliderTranslation;
use Faker\Generator as Faker;

$factory->define(BrandSliderTranslation::class, function (Faker $faker) {
    return [
        'brand_slider_id' => factory(BrandSlider::class)->create()->id,
        'locale' => 'en',
        'title' => $faker->sentence,
        'content' => $faker->realText(rand(25, 50)),
        'btn_text' => 'Click Me',
    ];
});

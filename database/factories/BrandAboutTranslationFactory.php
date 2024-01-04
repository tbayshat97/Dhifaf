<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BrandAbout;
use App\Models\BrandAboutTranslation;
use Faker\Generator as Faker;

$factory->define(BrandAboutTranslation::class, function (Faker $faker) {
    return [
        'brand_about_id' => factory(BrandAbout::class)->create()->id,
        'locale' => 'en',
        'title' => $faker->sentence,
        'description' => $faker->realText(rand(25, 50)),
    ];
});

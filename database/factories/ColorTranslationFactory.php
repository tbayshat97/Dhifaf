<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Color;
use App\Models\ColorTranslation;
use Faker\Generator as Faker;

$factory->define(ColorTranslation::class, function (Faker $faker) {
    return [
        'color_id' => factory(Color::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

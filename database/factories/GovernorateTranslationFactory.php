<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Governorate;
use App\Models\GovernorateTranslation;
use Faker\Generator as Faker;

$factory->define(GovernorateTranslation::class, function (Faker $faker) {
    return [
        'governorate_id' => factory(Governorate::class)->create()->id,
        'locale' => 'en',
        'title' => $faker->name,
    ];
});

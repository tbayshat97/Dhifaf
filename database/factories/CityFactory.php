<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use App\Models\Governorate;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'governorate_id' => Governorate::inRandomOrder()->limit(1)->first()->id,
    ];
});

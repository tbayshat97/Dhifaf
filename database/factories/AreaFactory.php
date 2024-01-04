<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use App\Models\City;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) {
    return [
        'city_id' => City::inRandomOrder()->limit(1)->first()->id,
        'delivery_fees' => 2,
    ];
});

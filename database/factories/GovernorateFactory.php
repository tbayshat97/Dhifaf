<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Governorate;
use Faker\Generator as Faker;

$factory->define(Governorate::class, function (Faker $faker) {
    return [
        'country_id' => 1
    ];
});

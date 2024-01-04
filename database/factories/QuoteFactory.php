<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Quote;
use Faker\Generator as Faker;

$factory->define(Quote::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'message' => $faker->realText(75)
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {
    $phone = '96278' . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);

    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'phone' => $phone,
    ];
});

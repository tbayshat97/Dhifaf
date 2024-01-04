<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Area;
use App\Models\City;
use App\Models\Customer;
use Faker\Generator as Faker;
use App\Models\CustomerAddress;
use App\Models\Governorate;

$factory->define(CustomerAddress::class, function (Faker $faker) {
    $phone = '96278' . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);

    return [
        'name' => $faker->name,
        'customer_id' => Customer::inRandomOrder()->limit(1)->first()->id,
        'city_id' => City::inRandomOrder()->limit(1)->first()->id,
        'area_id' => Area::inRandomOrder()->limit(1)->first()->id,
        'governorate_id' => Governorate::inRandomOrder()->limit(1)->first()->id,
        'mahala' => $faker->name,
        'zoqaq' => $faker->name,
        'dar' => $faker->name,
        'phone_number' => $phone,
    ];
});

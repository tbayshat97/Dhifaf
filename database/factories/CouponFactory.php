<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\DiscountType;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Coupon::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'code' => Str::random(12),
        'start_at' => date('Y-m-1 00:00:00'),
        'end_at' => date('Y-m-25 23:59:59'),
        'value' => $faker->numberBetween(1, 12),
        'ec_per_coupon' => $faker->numberBetween(50, 100),
        'ec_per_customer' => $faker->numberBetween(1, 3),
        'is_active' => $faker->randomElement([true, false]),
        'free_shipping' => $faker->randomElement([true, false]),
        'type' => DiscountType::getRandomValue()
    ];
});

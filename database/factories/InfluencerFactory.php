<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Influencer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Enums\InfluencerStatus;

$factory->define(Influencer::class, function (Faker $faker) {
    return [
        'username' => $faker->safeEmail,
        'password' => bcrypt('123456'),
        'account_verified_at' => now(),
        'is_blocked' => $faker->boolean(25),
        'remember_token' => Str::random(10),
        'status' => InfluencerStatus::getRandomValue(),
    ];
});

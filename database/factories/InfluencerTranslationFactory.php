<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Influencer;
use App\Models\InfluencerTranslation;
use Faker\Generator as Faker;

$factory->define(InfluencerTranslation::class, function (Faker $faker) {
    return [
        'influencer_id' => factory(Influencer::class)->create()->id,
        'locale' => 'en',
        'title' => $faker->firstName . ' ' . $faker->lastName,
        'bio' => $faker->realText,
        'description' => $faker->realText(rand(25, 50)),
    ];
});

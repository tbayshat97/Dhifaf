<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\DivisionBanner;
use App\Models\DivisionBannerTranslation;
use Faker\Generator as Faker;

$factory->define(DivisionBannerTranslation::class, function (Faker $faker) {
    return [
        'division_banner_id' => factory(DivisionBanner::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

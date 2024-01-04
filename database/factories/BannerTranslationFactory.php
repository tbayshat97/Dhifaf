<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Banner;
use App\Models\BannerTranslation;
use Faker\Generator as Faker;

$factory->define(BannerTranslation::class, function (Faker $faker) {
    return [
        'banner_id' => factory(Banner::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

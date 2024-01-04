<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BrandBanner;
use App\Models\BrandBannerTranslation;
use Faker\Generator as Faker;

$factory->define(BrandBannerTranslation::class, function (Faker $faker) {
    return [
        'brand_banner_id' => factory(BrandBanner::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

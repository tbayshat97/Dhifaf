<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Brand;
use App\Models\BrandTranslation;
use Faker\Generator as Faker;

$factory->define(BrandTranslation::class, function (Faker $faker) {
    return [
        'brand_id' => factory(Brand::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

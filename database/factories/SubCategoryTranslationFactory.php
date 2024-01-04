<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\SubCategory;
use App\Models\SubCategoryTranslation;
use Faker\Generator as Faker;

$factory->define(SubCategoryTranslation::class, function (Faker $faker) {
    return [
        'sc_id' => factory(SubCategory::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

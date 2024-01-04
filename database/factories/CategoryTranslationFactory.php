<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\CategoryTranslation;
use Faker\Generator as Faker;

$factory->define(CategoryTranslation::class, function (Faker $faker) {
    return [
        'category_id' => factory(Category::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CategoryDivision;
use Faker\Generator as Faker;
use App\Models\Category;
use App\Models\Division;

$factory->define(CategoryDivision::class, function (Faker $faker) {
    return [
        'category_id' => Category::inRandomOrder()->limit(1)->first()->id,
        'division_id' => Division::inRandomOrder()->limit(1)->first()->id,
    ];
});

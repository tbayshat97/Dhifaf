<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;


$factory->define(Category::class, function (Faker $faker) {
    $filepath_category = public_path('storage/category');
    if (!File::exists($filepath_category)) {
        File::makeDirectory($filepath_category, 0777, true);
    }

    return [
        'image' => 'category/' . $faker->image($filepath_category, 430, 500, ['technics'], false),
        'header' => 'category/' . $faker->image($filepath_category, 1920, 575, ['technics'], false),
    ];
});

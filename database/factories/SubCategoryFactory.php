<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\SubCategory;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(SubCategory::class, function (Faker $faker) {
    $filepath_subCategory = public_path('storage/subCategory');
    if (!File::exists($filepath_subCategory)) {
        File::makeDirectory($filepath_subCategory, 0777, true);
    }

    return [
        'category_id' => Category::inRandomOrder()->limit(1)->first()->id,
        'image' => 'subCategory/' . $faker->image($filepath_subCategory, 720, 1520, ['technics'], false),
        'header' => 'subCategory/' . $faker->image($filepath_subCategory, 1920, 575, ['technics'], false)
    ];
});

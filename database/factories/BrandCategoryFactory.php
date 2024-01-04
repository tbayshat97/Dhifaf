<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\BrandType;
use App\Models\Brand;
use App\Models\BrandCategory;
use App\Models\Category;
use Faker\Generator as Faker;

$factory->define(BrandCategory::class, function (Faker $faker) {
    return [
        'brand_id' => Brand::where('status', BrandType::Luxury)->inRandomOrder()->limit(1)->first()->id,
        'category_id' => Category::inRandomOrder()->limit(1)->first()->id,
    ];
});

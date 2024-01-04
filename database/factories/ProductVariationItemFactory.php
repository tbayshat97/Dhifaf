<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\ProductVariationItem;
use Faker\Generator as Faker;

$factory->define(ProductVariationItem::class, function (Faker $faker) {
    return [
        'product_id' => Product::inRandomOrder()->limit(1)->first()->id,
    ];
});

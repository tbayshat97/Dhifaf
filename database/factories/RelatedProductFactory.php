<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\RelatedProduct;
use Faker\Generator as Faker;

$factory->define(RelatedProduct::class, function (Faker $faker) {
    return [
        'product_id' => Product::inRandomOrder()->limit(1)->first()->id,
        'related_id' => Product::inRandomOrder()->limit(1)->first()->id,
    ];
});

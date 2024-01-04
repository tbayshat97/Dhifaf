<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CrossSaleProduct;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(CrossSaleProduct::class, function (Faker $faker) {
    return [
        'product_id' => Product::inRandomOrder()->limit(1)->first()->id,
        'cross_sale_id' => Product::inRandomOrder()->limit(1)->first()->id,
    ];
});

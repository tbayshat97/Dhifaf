<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\UpSaleProduct;
use Faker\Generator as Faker;

$factory->define(UpSaleProduct::class, function (Faker $faker) {
    return [
        'product_id' => Product::inRandomOrder()->limit(1)->first()->id,
        'up_sale_id' => Product::inRandomOrder()->limit(1)->first()->id,
    ];
});

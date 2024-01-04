<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\Favorite;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Favorite::class, function (Faker $faker) {
    return [
        'customer_id' => Customer::all()->random()->id,
        'product_id' => Product::all()->random()->id,
    ];
});

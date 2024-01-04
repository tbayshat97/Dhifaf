<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use App\Models\ProductTranslation;
use Faker\Generator as Faker;

$factory->define(ProductTranslation::class, function (Faker $faker) {
    return [
        'product_id' => factory(Product::class)->create()->id,
        'locale' => 'en',
        'title' => $faker->words(rand(2, 4), true),
        'description' => $faker->realText(rand(25, 50)),
    ];
});

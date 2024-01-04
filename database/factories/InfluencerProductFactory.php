<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Influencer;
use App\Models\InfluencerProduct;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(InfluencerProduct::class, function (Faker $faker) {
    return [
        'influencer_id' => Influencer::inRandomOrder()->limit(1)->first()->id,
        'product_id' => Product::inRandomOrder()->limit(1)->first()->id,
    ];
});

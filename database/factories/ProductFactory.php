<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\ProductStatus;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath_product = public_path('storage/product');
    if (!File::exists($filepath_product)) {
        File::makeDirectory($filepath_product, 0777, true);
    }

    $imagePath = 'product/' . $faker->image($filepath_product, 1000, 1000, ['technics'], false);

    $image = [
        'file' => $imagePath,
        'name' => 'Seeder',
        'size' => 41638,
        'local' => $imagePath,
        'type' => 'image/jpeg',
        'data' => [
            'url' => $imagePath,
            'thumbnail' => $imagePath,
            'readerForce' => true
        ],
    ];

    $price = $faker->randomFloat(1, 25, 130);

    return [
        'code' => Str::random(6),
        'barcode' => Str::random(12),
        'price' => $price,
        'qty' => rand(4, 100),
        'image' => json_encode([$image]),
        'switcher' => json_encode([$image]),
        'gallery' => json_encode([$image]),
        'is_variant' => false,
        'new_arrival' => $faker->boolean(),
        'special_offer' => $faker->boolean(),
        'best_sellers' => $faker->boolean(),
        'track_inventory' => $faker->boolean(),
        'status' => ProductStatus::getRandomValue(),
        'size_id' => Size::inRandomOrder()->limit(1)->first()->id,
        'color_id' => Color::inRandomOrder()->limit(1)->first()->id
    ];
});

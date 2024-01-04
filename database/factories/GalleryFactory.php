<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gallery;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(Gallery::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath_product = public_path('storage/gallery');
    if (!File::exists($filepath_product)) {
        File::makeDirectory($filepath_product, 0777, true);
    }

    $imagePath = 'gallery/' . $faker->image($filepath_product, 1000, 1000, ['technics'], false);
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
    return [
        'image' => json_encode([$image]),
    ];
});

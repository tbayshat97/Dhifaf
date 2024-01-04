<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\BrandType;
use App\Models\Brand;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

$factory->define(Brand::class, function (Faker $faker) {
    $filepath_brand = public_path('storage/brand');

    if (!File::exists($filepath_brand)) {
        File::makeDirectory($filepath_brand, 0777, true);
    }

    return [
        'username' => $faker->safeEmail,
        'password' => bcrypt('123456'),
        'account_verified_at' => now(),
        'remember_token' => Str::random(10),
        'image' => 'brand/' . $faker->image($filepath_brand, 430, 210, ['technics'], false),
        'header' => 'brand/' . $faker->image($filepath_brand, 1920, 575, ['technics'], false),
        'status' => BrandType::getRandomValue(),
    ];
});

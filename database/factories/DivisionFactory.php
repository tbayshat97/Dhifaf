<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Division;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(Division::class, function (Faker $faker) {
    $filepath_division = public_path('storage/division');
    if (!File::exists($filepath_division)) {
        File::makeDirectory($filepath_division, 0777, true);
    }

    return [
        'image' => 'division/' . $faker->image($filepath_division, 880, 640, ['technics'], false),
        'header' => 'division/' . $faker->image($filepath_division, 1920, 575, ['technics'], false),
    ];
});

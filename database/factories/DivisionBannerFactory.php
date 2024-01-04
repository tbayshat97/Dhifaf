<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Division;
use App\Models\DivisionBanner;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(DivisionBanner::class, function (Faker $faker) {
    $filepath_division = public_path('storage/division');
    if (!File::exists($filepath_division)) {
        File::makeDirectory($filepath_division, 0777, true);
    }

    return [
        'image' => 'division/',
        'division_id' => Division::inRandomOrder()->limit(1)->first()->id,
        'cta' => 'Click me',
    ];
});

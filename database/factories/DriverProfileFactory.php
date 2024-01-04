<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Driver;
use App\Enums\GenderTypes;
use App\Models\DriverProfile;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(DriverProfile::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath = public_path('storage/driver');
    if (!File::exists($filepath)) {
        File::makeDirectory($filepath, 0777, true);
    }
    return [
        'driver_id' => factory(Driver::class)->create()->id,
        'email' => $faker->unique()->safeEmail,
        'image' => 'driver/' . $faker->image($filepath, 600, 600, ['technics'], false),
        'birthdate' =>  $faker->date(),
        'gender' => GenderTypes::getRandomValue()
    ];
});

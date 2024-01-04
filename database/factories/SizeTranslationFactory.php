<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Size;
use App\Models\SizeTranslation;
use Faker\Generator as Faker;

$factory->define(SizeTranslation::class, function (Faker $faker) {
    return [
        'size_id' => factory(Size::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Division;
use App\Models\DivisionTranslation;
use Faker\Generator as Faker;

$factory->define(DivisionTranslation::class, function (Faker $faker) {
    return [
        'division_id' => factory(Division::class)->create()->id,
        'locale' => 'en',
        'name' => $faker->name,
    ];
});

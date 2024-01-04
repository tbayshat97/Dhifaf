<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Gallery;
use App\Models\GalleryTranslation;
use Faker\Generator as Faker;

$factory->define(GalleryTranslation::class, function (Faker $faker) {
    return [
        'gallery_id' => factory(Gallery::class)->create()->id,
        'locale' => 'en',
        'title' => $faker->words(rand(2, 4), true),
    ];
});

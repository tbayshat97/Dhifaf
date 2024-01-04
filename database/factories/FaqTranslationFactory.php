<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faq;
use App\Models\FaqTranslation;
use Faker\Generator as Faker;

$factory->define(FaqTranslation::class, function (Faker $faker) {
    return [
        'faq_id' => factory(Faq::class)->create()->id,
        'locale' => 'en',
        'question' => $faker->realText(rand(25, 50)) . '?',
        'answer' => $faker->realText(rand(25, 50)),
    ];
});

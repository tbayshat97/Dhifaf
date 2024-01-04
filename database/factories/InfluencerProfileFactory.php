<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enums\GenderTypes;
use App\Models\Influencer;
use App\Models\InfluencerProfile;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\File;

$factory->define(InfluencerProfile::class, function (Faker $faker) {
    $faker->addProvider(new Xvladqt\Faker\LoremFlickrProvider($faker));

    $filepath_influencer = public_path('storage/influencer');
    if (!File::exists($filepath_influencer)) {
        File::makeDirectory($filepath_influencer, 0777, true);
    }

    $imagePath = 'influencer/' . $faker->image($filepath_influencer, 600, 600, ['person'], false);

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

    $header = 'influencer/' . $faker->image($filepath_influencer, 1920, 575, ['person'], false);

    $headerImage = [
        'file' => $header,
        'name' => 'Seeder',
        'size' => 41638,
        'local' => $header,
        'type' => 'image/jpeg',
        'data' => [
            'url' => $header,
            'thumbnail' => $header,
            'readerForce' => true
        ],
    ];

    $phone = '96278' . str_pad(rand(0, 9999999), 7, '0', STR_PAD_LEFT);

    return [
        'influencer_id' => factory(influencer::class)->create()->id,
        'phone' => $phone,
        'birthdate' => ($faker->boolean(50)) ? $faker->date() : null,
        'gender' => GenderTypes::getRandomValue(),
        'image' => json_encode([$image]),
        'header' => json_encode([$headerImage]),
        'percentage' => $faker->unique()->numberBetween(1, 100)
    ];
});

 <?php

use App\Enums\AgeGroup;
use App\Enums\ProductGender;

return [
    AgeGroup::class => [
        AgeGroup::ZeroFourteen => '0 - 14',
        AgeGroup::FifteenTwentyFour => '15 - 24',
        AgeGroup::TwentyFiveSixtyFour => '25 - 64',
        AgeGroup::SixtyFiveAndOver => '65 and over',
        AgeGroup::All => 'All',
    ],
    ProductGender::class => [
        ProductGender::Male => 'Male',
        ProductGender::Female => 'Female',
        ProductGender::All => 'All',
    ],
];

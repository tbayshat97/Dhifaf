<?php

use App\Enums\AgeGroup;
use App\Enums\ProductGender;

return [
    AgeGroup::class => [
        AgeGroup::ZeroFourteen => '0 - 14',
        AgeGroup::FifteenTwentyFour => '15 - 24',
        AgeGroup::TwentyFiveSixtyFour => '25 - 64',
        AgeGroup::SixtyFiveAndOver => '65 وما فوق',
        AgeGroup::All => 'الكل',
    ],
    ProductGender::class => [
        ProductGender::Male => 'ذكر',
        ProductGender::Female => 'أنثى',
        ProductGender::All => 'الكل',
    ],
];

<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use BenSampo\Enum\Contracts\LocalizedEnum;

final class AgeGroup extends Enum implements LocalizedEnum
{
    const ZeroFourteen = 1;
    const FifteenTwentyFour = 2;
    const TwentyFiveSixtyFour = 3;
    const SixtyFiveAndOver = 4;
    const All = 5;
}

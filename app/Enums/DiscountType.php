<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class DiscountType extends Enum
{
    const Fixed = 1;
    const Percentage = 2;
}

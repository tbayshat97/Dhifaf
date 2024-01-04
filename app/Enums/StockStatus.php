<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StockStatus extends Enum
{
    const OutStock = 0;
    const InStock = 1;
    const OutOfStock = 2;
    const OnBackOrder = 3;
}

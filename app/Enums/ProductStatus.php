<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ProductStatus extends Enum
{
    const Draft = 1;
    const Published = 2;
    const Unpublished = 3;
}

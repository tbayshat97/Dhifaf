<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatus extends Enum
{
    const Pending = 1;
    const Accepted = 2;
    const Canceled = 3;
    const Delivered = 4;
    const Finished = 5;
}

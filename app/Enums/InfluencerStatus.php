<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class InfluencerStatus extends Enum
{
    const Pending = 1;
    const Actived = 2;
    const Blocked = 3;
}

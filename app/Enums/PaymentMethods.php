<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PaymentMethods extends Enum
{
    const CashOnDelivery = 1;
    const CreditCard = 2;
}

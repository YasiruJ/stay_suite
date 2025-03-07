<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BookingPaymentType extends Enum
{
    const ONLINE = 'online';

    const PAY_AT_LOCATION = 'pay_at_location';
}

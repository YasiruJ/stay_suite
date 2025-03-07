<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BookingStatusType extends Enum
{
    const PENDING = 'pending';

    const CONFIRMED = 'confirmed';

    const PAYMENT_REJECTED = 'payment-rejected';

    const REJECTED = 'rejected';

    const BOOKING_DONE = 'booking-done';

    const PAYMENT_SETTLED = 'payment-settled';

    const ABSENT = 'absent';
}

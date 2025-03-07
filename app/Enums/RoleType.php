<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SUPER_ADMIN()
 * @method static static ADMIN()
 * @method static static PROPERTY_OWNER()
 * @method static static CUSTOMER()
 * @method static static REFERRAL_USER()
 * @method static static CALL_CENTER()
 */
final class RoleType extends Enum
{
    const SUPER_ADMIN = 'super-admin';

    const ADMIN = 'admin';

    const PROPERTY_OWNER = 'property-owner';

    const CUSTOMER = 'customer';

    const REFERRAL_USER = 'referral-user';

    const CALL_CENTER = 'call-center';
}

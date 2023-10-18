<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static New()
 * @method static static Read()
 * @method static static Deleted()
 */
final class UserNotificationStatus extends Enum
{
    const New = 0;
    const Read = 1;
    const Deleted = 5;
}

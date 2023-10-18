<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static InActive()
 * @method static static Active()
 * @method static static Deleted()
 */
final class UserStatus extends Enum
{
    const InActive = 0;
    const Active = 5;
    const Deleted = 10;
}

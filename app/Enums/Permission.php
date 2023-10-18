<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Error()
 */
final class Permission extends Enum
{
    const Error = 'Sorry, you do not have permission to perform this action, upgrade your plan to proceed.';
}

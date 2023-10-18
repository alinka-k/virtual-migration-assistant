<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static lessThanThreeMonths()
 * @method static static threeMonths()
 * @method static static sixMonths()
 */
class WorkDuration extends Enum
{
    const lessThanThreeMonths = '0';
    const threeMonths = '0.25';
    const sixMonths = '0.5';
    const nineMonths = '0.75';
}

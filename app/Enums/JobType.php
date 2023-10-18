<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static NOC_ZERO()
 * @method static static NOC_A()
 * @method static static NOC_B()
 * @method static static NOC_C()
 * @method static static NOC_D()
 * @method static static NOC_C_D()
 */
final class JobType extends Enum
{
    const NOC_0 = '0';
    const NOC_A = 'A';
    const NOC_B = 'B';
    const NOC_C = 'C';
    const NOC_D = 'D';
    const NOC_C_D = 'C_D';
}

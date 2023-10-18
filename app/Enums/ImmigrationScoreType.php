<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static FSW()
 * @method static static CRS()
 * @method static static CEC()
 * @method static static FSTP()
 */
final class ImmigrationScoreType extends Enum
{
    const FSW = 'fsw';
    const CRS = 'crs';
    const CEC = 'cec';
    const FSTP = 'fstp';
}

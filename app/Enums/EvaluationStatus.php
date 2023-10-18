<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static draft()
 * @method static static published()
 * @method static static finished()
 * @method static static error()
 */
final class EvaluationStatus extends Enum
{
    const draft = 'draft';
    const published = 'published';
    const finished = 'finished';
    const error = 'error';
}

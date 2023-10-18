<?php

namespace App\Services\Points\CRSHelpers;

use Arr;

class SumPointsHelper
{
    public static function getCurrentPoints(array $fswScoreLog, array $fswScoreKeys, bool $married): int
    {
        $sum = 0;
        foreach ($fswScoreKeys as $key) {
            if (is_array(Arr::get($fswScoreLog, $key))) {
                $sum += $married ? (int)Arr::get($fswScoreLog, $key . '.married', 0) : (int)Arr::get($fswScoreLog, $key . '.single', 0);
            } else {
                $sum += (int)Arr::get($fswScoreLog, $key, 0);
            }
        }

        return $sum;
    }
}

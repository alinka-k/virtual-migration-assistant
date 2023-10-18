<?php

namespace App\Services\Points\FSWHelpers;

use Arr;

class SumPointsHelper implements SumPointsInterface
{
    public function getCurrentPoints(array $fswScoreLog, array $fswScoreKeys): int
    {
        $sum = 0;
        foreach ($fswScoreKeys as $key) {
            $sum += (int) Arr::get($fswScoreLog, $key, 0);
        }

        return $sum;
    }
}

<?php

namespace App\Services\Points\FSWHelpers;

interface SumPointsInterface
{
    public function getCurrentPoints(array $fswScoreLog, array $fswScoreKeys): int;
}

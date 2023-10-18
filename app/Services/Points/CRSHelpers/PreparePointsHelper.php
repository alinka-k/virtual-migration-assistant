<?php

namespace App\Services\Points\CRSHelpers;

interface PreparePointsHelper
{
    public static function getCurrentPoints(array $fswScoreLog, array $fswScoreKeys, bool $married): int;

    public static function prepareData(array $data, array $fswScoreLog, bool $married): array;
}

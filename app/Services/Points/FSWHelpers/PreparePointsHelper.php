<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;

interface PreparePointsHelper
{
    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array;
}

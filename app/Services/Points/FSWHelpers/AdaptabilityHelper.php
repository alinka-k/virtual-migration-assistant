<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;
use App\Services\Points\FSWHelpers\StrapiHelpers\StrapiAdaptabilityHelper;
use Arr;

class AdaptabilityHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'adaptability' => 'fsw_adaptability_score',
    ];

    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array
    {
        return [
            'title' => 'Adaptability',
            'subtitle' => 'My Adaptability Status',
            'html' => StrapiAdaptabilityHelper::checkRule(Arr::get($strapiData, 'adaptability', []), $fswScoreLog, self::FSW_SCORE_KEYS),
            'currentPoint' => $this->getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS),
            'maxPoint' => Arr::get($data, 'max_points'),
            'subsections' => [
                [
                    'html' => Arr::get(Arr::get($strapiData, 'adaptability', []), 'rule_0', ''),
                    'items' => $this->prepareAdaptabilityItems(Arr::get($data, 'factors', [])),
                ],
            ],
        ];
    }

    private function prepareAdaptabilityItems(array $factors): array
    {
        array_unshift($factors, ['label' => 'Adaptability', 'points' => 'Points']);
        return $factors;
    }
}

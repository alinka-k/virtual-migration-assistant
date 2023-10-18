<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;
use App\Services\Points\FSWHelpers\StrapiHelpers\StrapiAgeHelper;
use Arr;

class AgeHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'age' => 'fsw_age_score',
    ];

    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array
    {
        return [
            'title' => 'Age',
            'subtitle' => 'My Age Status',
            'html' => StrapiAgeHelper::checkRule(Arr::get($strapiData, 'age', []), $user),
            'currentPoint' => $this->getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS),
            'maxPoint' => Arr::get($data, 'max_points'),
            'subsections' => [
                [
                    'html' => Arr::get(Arr::get($strapiData, 'age', []), 'rule_0', ''),
                    'items' => $this->prepareAgeItems(Arr::get($data, 'factors', [])),
                ],
            ],
        ];
    }

    private function prepareAgeItems(array $factors): array
    {
        array_unshift($factors, ['label' => 'Age of Applicant', 'points' => 'Points']);
        return $factors;
    }
}

<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;
use App\Services\Points\FSWHelpers\StrapiHelpers\StrapiWorkHelper;
use Arr;

class WorkHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'work_experience' => 'fsw_work_experience_score',
    ];

    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array
    {
        return [
            'title' => 'Work Experience',
            'subtitle' => 'My Work Experience Status',
            'html' => StrapiWorkHelper::checkRule(Arr::get($strapiData, 'work_experience', []), $fswScoreLog, self::FSW_SCORE_KEYS),
            'currentPoint' => $this->getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS),
            'maxPoint' => Arr::get($data, 'max_points'),
            'subsections' => [
                [
                    'html' => Arr::get(Arr::get($strapiData, 'work_experience', []), 'rule_0', ''),
                    'items' => $this->prepareJobOfferItems(Arr::get($data, 'factors', [])),
                ],
            ],
        ];
    }

    private function prepareJobOfferItems(array $factors): array
    {
        array_unshift($factors, ['label' => 'Factor', 'points' => 'Points']);
        return $factors;
    }
}

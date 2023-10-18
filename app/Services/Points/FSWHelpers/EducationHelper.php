<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;
use App\Services\Points\FSWHelpers\StrapiHelpers\StrapiEducationHelper;
use Arr;

class EducationHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'education' => 'fsw_education_score',
    ];

    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array
    {
        return [
            'title' => 'Education',
            'subtitle' => 'My Education Status',
            'html' => StrapiEducationHelper::checkRule(Arr::get($strapiData, 'education', []), $fswScoreLog, self::FSW_SCORE_KEYS),
            'currentPoint' => $this->getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS),
            'maxPoint' => Arr::get($data, 'max_points'),
            'subsections' => [
                [
                    'html' => Arr::get(Arr::get($strapiData, 'education', []), 'rule_0', ''),
                    'items' => $this->prepareEducationItems(Arr::get($data, 'factors', [])),
                ],
            ],
        ];
    }

    private function prepareEducationItems(array $factors): array
    {
        array_unshift($factors, ['label' => 'Level of Education', 'points' => 'Points']);
        return $factors;
    }
}

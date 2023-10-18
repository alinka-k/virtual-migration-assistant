<?php

namespace App\Services\Points\CRSHelpers\CoreHumanCapital;

use App\Services\Points\CRSHelpers\SumPointsHelper;
use App\Services\Points\CRSHelpers\PreparePointsHelper;
use Arr;

class EducationHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'fsw_education_crs',
    ];

    public static function prepareData(array $data, array $fswScoreLog, bool $married): array
    {
        return [
            'title' => 'Education',
            'currentPoint' => self::getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS, $married),
            'maxPoint' => $married ? Arr::get($data, 'max_points.married') : Arr::get($data, 'max_points.single'),
            'subsections' => [
                [
                    'items' => self::prepareEducationItems(Arr::get($data, 'factors', []), $married),
                ],
            ],
        ];
    }

    private static function prepareEducationItems(array $factors, bool $married): array
    {
        $prepareData = [
            ['label' => 'Level of Education', 'points' => 'Points'],
        ];

        foreach ($factors as $key => $factor) {
            $prepareData[$key + 1][0] = $factor['label'];
            $prepareData[$key + 1][1] = $married ?
                Arr::get($factor, 'points.married', 0) :
                Arr::get($factor, 'points.single', 0);
        }
        return $prepareData;
    }
}

<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;
use App\Services\Points\FSWHelpers\StrapiHelpers\StrapiJobOfferHelper;
use Arr;

class JobOfferHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'jobOffer' => 'fsw_adaptability_valid_canadian_job_offer_score'
    ];

    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array
    {
        return [
            'title' => 'Arranged Employment in Country',
            'subtitle' => 'My Arranged Employment in Country Status',
            'html' => StrapiJobOfferHelper::checkRule(Arr::get($strapiData, 'job_offer', []), $fswScoreLog, self::FSW_SCORE_KEYS),
            'currentPoint' => $this->getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS),
            'maxPoint' => Arr::get($data, 'max_points'),
            'subsections' => [
                [
                    'html' => Arr::get(Arr::get($strapiData, 'job_offer', []), 'rule_0', ''),
                    'items' => [],
                ],
            ],
        ];
    }
}

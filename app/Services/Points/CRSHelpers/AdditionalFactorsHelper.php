<?php

namespace App\Services\Points\CRSHelpers;

use App\Services\Points\CRSHelpers\AdditionalFactors\CanadianStudy;
use App\Services\Points\CRSHelpers\AdditionalFactors\FrenchLanguage;
use App\Services\Points\CRSHelpers\AdditionalFactors\ProvincialNominationCertificate;
use App\Services\Points\CRSHelpers\AdditionalFactors\QualifyingOffer;
use App\Services\Points\CRSHelpers\AdditionalFactors\SiblingInCanada;
use App\Services\Points\CRSHelpers\AdditionalFactors\SubsectionInterface;

class AdditionalFactorsHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'fsw_bonus_points_crs',
    ];

    const SUBSECTION_MAPPER = [
        0 => ProvincialNominationCertificate::class,
        1 => QualifyingOffer::class,
        2 => CanadianStudy::class,
        3 => FrenchLanguage::class,
        4 => SiblingInCanada::class,
    ];

    const SUBSECTION_LABELS_MAPPER = [
        0 => 'Nomination certificate from a Canadian province (except Quebec)',
        1 => 'Qualifying offer of arranged employment',
        2 => 'Canadian study experience',
        3 => 'French language ability',
        4 => 'Sibling in Canada',
    ];

    public static function prepareData(array $data, array $fswScoreLog, bool $married): array
    {
        return [
            'title' => 'Additional Factors',
            'currentPoint' => self::getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS, $married),
            'maxPoint' => $data['max_points'],
            'subsections' => self::prepareSubsections($data['factors']),
        ];
    }

    private static function prepareSubsections(array $data): array
    {
        $prepareData = [];

        foreach ($data as $subSectionData) {
            if (in_array($subSectionData['label'], self::SUBSECTION_LABELS_MAPPER)) {
                $className = self::SUBSECTION_MAPPER[array_search($subSectionData['label'], self::SUBSECTION_LABELS_MAPPER)];
                /** @var SubsectionInterface $subSection */
                $subSection = new $className($subSectionData);
                $prepareData[] = $subSection->prepareSubsection();
            }
        }

        return $prepareData;
    }
}

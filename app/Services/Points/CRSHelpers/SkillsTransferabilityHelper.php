<?php

namespace App\Services\Points\CRSHelpers;

use App\Services\Points\CRSHelpers\SkillsTransferability\CertificateOfQualification;
use App\Services\Points\CRSHelpers\SkillsTransferability\Education;
use App\Services\Points\CRSHelpers\SkillsTransferability\NonCanadianWorkExperience;
use App\Services\Points\CRSHelpers\SkillsTransferability\SubsectionInterface;
use Arr;

class SkillsTransferabilityHelper extends SumPointsHelper implements PreparePointsHelper
{
    const FSW_SCORE_KEYS = [
        'fsw_skill_transferability_crs',
    ];

    const SUBSECTION_MAPPER = [
        'Education' => Education::class,
        'Non-Canadian work experience' => NonCanadianWorkExperience::class,
        'Certificate of qualification in a trade occupation issued by a province' => CertificateOfQualification::class,
    ];

    public static function prepareData(array $data, array $fswScoreLog, bool $married): array
    {
        return [
            'title' => 'Skills Transferibility',
            'currentPoint' => self::getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS, $married),
            'maxPoint' => $data['max_points'],
            'subsections' => self::prepareSubsections($data['factors']),
            ];
    }

    private static function prepareSubsections(array $data): array
    {
        $prepareData = [];

        foreach ($data as $subSectionData) {
            if (Arr::has(self::SUBSECTION_MAPPER, $subSectionData['label'])) {
                $className = self::SUBSECTION_MAPPER[$subSectionData['label']];
                /** @var SubsectionInterface $subSection */
                $subSection = new $className($subSectionData);
                $prepareData[] = $subSection->prepareSubsection();
            }
        }

        return $prepareData;
    }
}

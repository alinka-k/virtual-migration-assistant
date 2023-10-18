<?php

namespace App\Services\Points;

use App\Services\Points\CRSHelpers\AdditionalFactorsHelper;
use App\Services\Points\CRSHelpers\CoreHumanCapital\AgeHelper;
use App\Services\Points\CRSHelpers\CoreHumanCapital\EducationHelper;
use App\Services\Points\CRSHelpers\CoreHumanCapital\LanguageHelper;
use App\Services\Points\CRSHelpers\CoreHumanCapital\CanadianHelper;
use App\Services\Points\CRSHelpers\SkillsTransferabilityHelper;
use App\Services\Points\CRSHelpers\PreparePointsHelper;
use Arr;

class CRSSectionsBuilder
{
    const CRS_MAPPER = [
        'skill_tranferability' => SkillsTransferabilityHelper::class,
        'additional_factors' => AdditionalFactorsHelper::class,
    ];

    const CORE_HUMAN_CAPITAL_MAPPER = [
        'language' => LanguageHelper::class,
        'education' => EducationHelper::class,
        'canadian_work_experience' => CanadianHelper::class,
        'age' => AgeHelper::class,
    ];

    public function prepareData(array $crs, bool $married): array
    {
        $crsLog = Arr::get($crs, 'log', []);
        $coreHumanCapitalRules = Arr::get($crs, 'scoring_rules.core_human_capital', []);
        $scoringRules = Arr::get($crs, 'scoring_rules', []);
        $prepareFSWData = [];

        foreach (self::CORE_HUMAN_CAPITAL_MAPPER as $sectionName => $class) {
            /** @var $class PreparePointsHelper */
            if (Arr::has($coreHumanCapitalRules, $sectionName)) {
                $prepareFSWData[] = $class::prepareData(
                    Arr::get($coreHumanCapitalRules, $sectionName),
                    $crsLog,
                    $married
                );
            }
        }

        foreach (self::CRS_MAPPER as $sectionName => $class) {
            /** @var $class PreparePointsHelper */
            if (Arr::has($scoringRules, $sectionName)) {
                $prepareFSWData[] = $class::prepareData(
                    Arr::get($scoringRules, $sectionName),
                    $crsLog,
                    false
                );
            }
        }

        return $prepareFSWData;
    }
}

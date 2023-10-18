<?php

namespace App\Services\Points\FSWHelpers;

use Illuminate\Support\Arr;

class SectionsBuilder
{
    const SECTIONS = [
        'language' => LanguageHelper::class,
        'education' => EducationHelper::class,
        'work_experience' => WorkHelper::class,
        'age' => AgeHelper::class,
        'job_offer' => JobOfferHelper::class,
        'adaptability' => AdaptabilityHelper::class,
        'money' => MoneyHelper::class,
    ];

    public function build($user, $sectionsDescription)
    {
        $evaluation = $user->evaluations()->whereNull('virtual_profile_id')->get()->last();
        $fswLog = Arr::get(json_decode(Arr::get($evaluation->points, 'fsw', ''), true), 'log', []);
        $scoringRules = Arr::get(json_decode(Arr::get($evaluation->points, 'fsw', ''), true), 'scoring_rules', []);
        $sections = [];
        $strapiContent = $this->prepareStrapiContent($sectionsDescription);

        foreach (self::SECTIONS as $sectionName => $className) {
            /** @var $class PreparePointsHelper */
            $class = new $className();
            $sections[] = $class->prepareData(
                Arr::get($scoringRules, $sectionName, []),
                $fswLog,
                Arr::get($strapiContent, $sectionName, []),
                $user
            );
        }

        return $sections;
    }

    private function prepareStrapiContent($sectionsDescription): array
    {
        $strapiContent = [];

        foreach ($sectionsDescription as $rule) {
            $rule_id = 'rule_' . $rule['rule_id'];
            $strapiContent[$rule['Name']][$rule['Related']][$rule_id] = $rule['html'];
        }

        return $strapiContent;
    }
}

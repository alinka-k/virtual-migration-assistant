<?php

namespace App\Services\Points\FSWHelpers;

use App\Models\User;
use Arr;
use App\Services\Points\FSWHelpers\StrapiHelpers\StrapiLanguageHelper;

class LanguageHelper extends SumPointsHelper implements PreparePointsHelper
{
    const LANGUAGE_TITLE = [
        'primary' => 'First Official Language',
        'secondary' => 'Second Official Language',
    ];

    const FSW_SCORE_KEYS = [
        'primary' => 'fsw_1st_language_score',
        'secondary' => 'fsw_2nd_language_score',
    ];

    public function prepareData(array $data, array $fswScoreLog, array $strapiData, User $user): array
    {
        [$subsection, $maxPoint] = $this->prepareLanguagesSubsections($data, $strapiData);

        return [
            'title' => 'Language Skills',
            'subtitle' => 'My Language Status',
            'html' => StrapiLanguageHelper::checkRule(Arr::get($strapiData, 'language', []), $fswScoreLog, self::FSW_SCORE_KEYS),
            'currentPoint' => $this->getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS),
            'maxPoint' => $maxPoint,
            'subsections' => $subsection,
        ];
    }

    private function prepareLanguagesSubsections(array $data, array $strapiData): array
    {
        $maxPoint = 0;
        $prepareLanguagesData = [];

        foreach ($data as $languageType => $language) {
            $prepareLanguagesData[] = [
                'title' => $this::LANGUAGE_TITLE[$languageType],
                'html' => Arr::get(Arr::get($strapiData, $languageType, []), 'rule_0', ''),
                'items' => $this->prepareLanguagesItems($language['factors'], $languageType),
            ];

            $maxPoint += $language['max_points'];
        }
        $prepareData['items'] = $prepareLanguagesData;

        return [$prepareLanguagesData, $maxPoint];
    }

    private function prepareLanguagesItems(array $factors, string $languageType): array
    {
        $prepareData = [
            ['CLB Level'],
            [],
            [],
            [],
            [],
        ];
        if ($languageType === 'secondary') {
            array_unshift($factors, ['label' => 'Level of Education', 'points' => 'Points']);
            $prepareData = $factors;
        } elseif ($languageType === 'primary') {
            $prepareData[0] = array_merge($prepareData[0], array_map('ucfirst', array_keys($factors)));
            $counter = 1;
            foreach ($factors as $type => $typeFactors) {
                foreach ($typeFactors as $key => $value) {
                    $prepareData[$key + 1][0] = $value['label'] . (Arr::has($value, 'note') ? '(' . $value['note'] . ')' : '');
                    $prepareData[$key + 1][$counter] = $value['points'];
                }
                $counter++;
            }
        }
        return $prepareData;
    }
}

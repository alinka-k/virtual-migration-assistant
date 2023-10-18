<?php

namespace App\Services\Points\CRSHelpers\CoreHumanCapital;

use App\Services\Points\CRSHelpers\SumPointsHelper;
use App\Services\Points\CRSHelpers\PreparePointsHelper;
use Arr;

class LanguageHelper extends SumPointsHelper implements PreparePointsHelper
{
    const LANGUAGE_TITLE = [
        'primary' => 'First Language Ability',
        'secondary' => 'Second Language Ability',
    ];

    const FSW_SCORE_KEYS = [
        'fsw_1sl_language_crs',
        'fsw_2nd_language_crs',
    ];

    public static function prepareData(array $data, array $fswScoreLog, bool $married): array
    {
        [$subsection, $maxPoint] = self::prepareLanguagesSubsections($data, $married);

        return [
            'title' => 'Language Skills',
            'currentPoint' => self::getCurrentPoints($fswScoreLog, self::FSW_SCORE_KEYS, $married),
            'maxPoint' => $maxPoint,
            'subsections' => $subsection,
        ];
    }

    private static function prepareLanguagesSubsections(array $data, bool $married): array
    {
        $maxPoint = 0;
        $prepareLanguagesData = [];

        foreach ($data as $languageType => $language) {
            $prepareLanguagesData[] = [
                'title' => self::LANGUAGE_TITLE[$languageType],
                'items' => self::prepareLanguagesItems($language['factors'], $married),
            ];

            $maxPoint += Arr::get($language, 'max_points.single');
        }

        return [$prepareLanguagesData, $maxPoint];
    }

    private static function prepareLanguagesItems(array $factors, bool $married): array
    {
        $prepareData = [
            array_merge(['CLB Level'], array_map('ucfirst', array_keys($factors))),
            [],
            [],
            [],
            [],
        ];

        $counter = 1;
        foreach ($factors as $typeFactors) {
            foreach ($typeFactors as $key => $value) {
                $prepareData[$key + 1][0] = Arr::get($value, 'label', '');
                if (is_array(Arr::get($value, 'points')) && Arr::has($value, 'points.married')) {
                    $prepareData[$key + 1][$counter] = $married ?
                    Arr::get($value, 'points.married', 0) :
                    Arr::get($value, 'points.single', 0) ;
                } else {
                    $prepareData[$key + 1][$counter] = Arr::get($value, 'points');
                }
            }
            $counter++;
        }

        return $prepareData;
    }
}

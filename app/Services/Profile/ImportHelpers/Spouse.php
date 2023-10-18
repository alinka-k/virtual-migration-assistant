<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class Spouse implements ParseProfileInterface
{
    const MAP_EDUCATION_LEVEL = [
        'None' => 'None',
        'Secondary' => 'Secondary',
        '1 yr diploma' => '1 yr diploma',
        '2 yr diploma' => '2 yr diploma',
        'Bachelor' => 'Bachelor',
        '2 diplomas' => '2 diplomas',
        'Master' => 'Master',
        'PhD' => 'Ph.D',
    ];

    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        if (!Arr::get($data, 'spouse')) {
            return true;
        }
        if ($user->spouse) {
            $user->spouse->delete();
        }

        $model = $user->spouse()->firstOrNew();
        $prepareSpouseData = self::prepareDataToFill($data);
        $model->fill($prepareSpouseData);

        return $model->save();
    }

    public static function prepareDataToFill($data): array
    {
        $spouseData = Arr::get($data, 'spouse', []) ?? [];
        $prepareData = [
            'age' => Arr::get($spouseData, 'age'),
            'education_level' => self::getEducationLevel(Arr::get($spouseData, 'education.max_degree')),
        ];

        foreach (Arr::get($spouseData, 'language', []) as $language) {
            // from virtual service reading == writing == speaking == listening
            $prepareData[$language['language']] = Arr::get($language, 'skills.reading');
        }

        if (Arr::get($spouseData, 'work.has_work_experience_10_yr')) {
            foreach (Arr::get($spouseData, 'work.history', []) as $workItem) {
                if (Arr::get($workItem, 'location') === 'Other') {
                    $prepareData['has_foreign_work'] = 1;
                    $prepareData['foreign_exp_years'] = Arr::get($workItem, 'duration_years');
                } elseif (Arr::get($workItem, 'location') === 'Canada') {
                    $prepareData['has_canadian_work'] = 1;
                    $prepareData['canadian_exp_years'] = Arr::get($workItem, 'duration_years');
                }
            }
        }

        return $prepareData;
    }

    public static function getEducationLevel($level): ?string
    {
        if (array_key_exists($level, self::MAP_EDUCATION_LEVEL)) {
            return self::MAP_EDUCATION_LEVEL[$level];
        }
        return null;
    }
}

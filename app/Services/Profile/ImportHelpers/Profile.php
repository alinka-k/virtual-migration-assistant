<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class Profile implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $model = $user->profile()->firstOrNew();
        $model->fill(self::prepareDataToFill($data));
        return $model->save();
    }

    public static function prepareDataToFill($data): array
    {
        $prepareData = Arr::only($data, [
            'age',
            'marital_status',
            'residence_country',
            'destination_province',
            'manitoba_city_preference',
            'stay_in_quebec',
            'stay_in_quebec_duration',
            'has_children',
            'children_0_12',
            'children_13_18',
        ]);

        $prepareData['dob'] = now()->subYears(Arr::get($prepareData, 'age'));
        $prepareData['children_0_12'] = Arr::get($prepareData, 'children_0_12', 0);
        $prepareData['children_13_18'] = Arr::get($prepareData, 'children_13_18', 0);

        return $prepareData;
    }
}

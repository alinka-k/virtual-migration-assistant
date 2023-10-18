<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class Language implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $languageData = self::prepareDataToFill($data);
        foreach ($languageData as $languageItem) {
            $prepareLanguageItem = self::prepareItemDataToFill($languageItem);
            $conditions = ['language_type' => $prepareLanguageItem['language_type']];
            $lang = $user->languages()->firstOrNew($conditions);
            if ($lang) {
                $lang->delete();
            }
            $model = $user->languages()->firstOrNew($conditions);
            $model->fill($prepareLanguageItem);
            if (!$model->save()) {
                return false;
            }
        }

        return true;
    }

    private static function prepareItemDataToFill($item): array
    {
        return [
            'language_type' => Arr::get($item, 'language'),
            'writing' => Arr::get($item, 'skills.writing'),
            'reading' => Arr::get($item, 'skills.reading'),
            'speaking' => Arr::get($item, 'skills.speaking'),
            'listening' => Arr::get($item, 'skills.listening'),
            'has_test' => 0
        ];
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'language', []) ?? [];
    }
}

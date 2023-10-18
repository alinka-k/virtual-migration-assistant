<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class ExpressEntry implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $expressEntryData = self::prepareDataToFill($data);
        if (empty($expressEntryData)) {
            return true;
        }
        if ($user->express) {
            $user->express->delete();
        }
        $model = $user->express()->firstOrNew();
        $model->fill($expressEntryData);

        return $model->save();
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'express_entry', []) ?? [];
    }
}

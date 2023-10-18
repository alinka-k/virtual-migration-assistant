<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class Manitoba implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $manitobaData = self::prepareDataToFill($data);
        if (empty($manitobaData)) {
            return true;
        }
        if ($user->manitoba) {
            $user->manitoba->delete();
        }
        $model = $user->manitoba()->firstOrNew();
        $model->fill($manitobaData);
        return $model->save();
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'manitoba', []) ?? [];
    }
}

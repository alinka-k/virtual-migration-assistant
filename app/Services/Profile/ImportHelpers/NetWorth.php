<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class NetWorth implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $netWorthData = self::prepareDataToFill($data);
        if (empty($netWorthData)) {
            return true;
        }
        if ($user->netWorth) {
            $user->netWorth->delete();
        }
        $model = $user->netWorth()->firstOrNew();
        $model->fill($netWorthData);
        return $model->save();
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'personal_net_worth', []) ?? [];
    }
}

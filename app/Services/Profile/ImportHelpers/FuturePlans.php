<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class FuturePlans implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        if ($user->futurePlan) {
            return $user->futurePlan->delete();
        }
        return true;
    }

    public static function prepareDataToFill($data): array
    {
        return [];
    }
}

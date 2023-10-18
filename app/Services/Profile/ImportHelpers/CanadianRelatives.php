<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use App\Models\User\UsersCanadianRelativeItem;
use Arr;

class CanadianRelatives implements ParseProfileInterface
{
    private const FRIEND_RELATIONSHIP = 'friend';

    protected const EMPTY_ITEM = [
        'relationship' => null,
        'canadian_status' => null,
        'province' => null,
        'residency_duration' => null,
    ];

    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $relativesData = self::prepareDataToFill($data);
        if (empty($relativesData)) {
            return true;
        }
        if ($user->relative) {
            $user->relative->delete();
        }
        $model = $user->relative()->firstOrNew();
        $model->fill($relativesData);
        if (!$model->save()) {
            return false;
        }

        foreach (Arr::get($relativesData, 'relatives', []) as $item) {
            if ($item == self::EMPTY_ITEM || $item['relationship'] === self::FRIEND_RELATIONSHIP) {
                continue;
            }
            $relativeModel = new UsersCanadianRelativeItem();
            $relativeModel->fill($item);
            if (!$model->items()->save($relativeModel)) {
                return false;
            }
        }

        return true;
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'canadian_relatives', []) ?? [];
    }
}

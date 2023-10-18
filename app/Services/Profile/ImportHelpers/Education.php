<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use App\Models\User\UsersEducationItem;
use Arr;

class Education implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $educationData = self::prepareDataToFill($data);
        if (empty($educationData)) {
            return true;
        }
        if ($user->education) {
            $user->education->delete();
        }
        $model = $user->education()->firstOrNew();
        $model->fill($educationData);
        if (!$model->save()) {
            return false;
        }

        foreach (Arr::get($educationData, 'post_secondary_education', []) as $item) {
            if (Arr::get($item, 'type_of_program') === 'null') {
                continue;
            }
            $educationModel = new UsersEducationItem();
            $educationModel->fill($item);
            if (!$model->items()->save($educationModel)) {
                return false;
            }
        }

        return true;
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'education', []) ?? [];
    }
}

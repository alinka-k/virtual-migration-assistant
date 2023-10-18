<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use Arr;

class Comments implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $commentData = self::prepareDataToFill($data);
        if (empty($commentData)) {
            return true;
        }
        if ($user->comment) {
            $user->comment->delete();
        }
        $model = $user->comment()->firstOrNew();
        $model->fill($commentData);
        return $model->save();
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'comments', []);
    }
}

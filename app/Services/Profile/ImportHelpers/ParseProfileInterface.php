<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;

interface ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool;

    public static function prepareDataToFill($data): array;
}

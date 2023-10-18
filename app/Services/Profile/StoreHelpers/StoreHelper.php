<?php

namespace App\Services\Profile\StoreHelpers;

use App\Http\Requests\User\UserPersonalRequest;

interface StoreHelper
{
    public static function saveUserData(UserPersonalRequest $user): bool;
}

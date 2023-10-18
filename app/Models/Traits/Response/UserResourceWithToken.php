<?php

namespace App\Models\Traits\Response;

use App\Http\Resources\User\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;

trait UserResourceWithToken
{
    public function userWithToken(User $user, string $token): JsonResponse
    {
        return (new UserResource($user))
            ->response()
            ->header('Access-Control-Expose-Headers', 'Authorization')
            ->header('Authorization', 'Bearer ' . $token);
    }
}

<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class UserController extends ApiController
{
    /**
     * @OA\Get (
     *      path="/auth/user",
     *      operationId="user",
     *      tags={"auth"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResourceResponse")
     *      )
     * )
     * @param Request $request
     * @return UserResource
     */
    public function index(Request $request)
    {
        return new UserResource($request->user());
    }
}

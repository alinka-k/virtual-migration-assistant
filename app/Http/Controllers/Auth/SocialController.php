<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\SocialRegistered;
use App\Http\Controllers\ApiController;
use App\Models\Traits\Response\UserResourceWithToken;
use App\Repositories\SocialAccountRepository;
use App\Services\JwtTokenService;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends ApiController
{
    use UserResourceWithToken;

    protected SocialAccountRepository $socialRepository;
    protected JwtTokenService $service;

    public function __construct(SocialAccountRepository $socialRepository, JwtTokenService $service)
    {
        $this->socialRepository = $socialRepository;
        $this->service = $service;
    }

    /**
     * @OA\Post (
     *      path="/auth/facebook",
     *      operationId="postFacebook",
     *      tags={"auth"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthSocial")
     *      ),
     *       @OA\Response(
     *          response=200,
     *          description="Ok",
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse"),
     *       ),
     *       @OA\Response(response=422, description="Something went wrong."),
     *     )
     *
     * @return JsonResponse
     */
    public function facebook(): JsonResponse
    {
        return $this->social('facebook');
    }

    /**
     * @OA\Post (
     *      path="/auth/google",
     *      operationId="postGoogle",
     *      tags={"auth"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthSocial")
     *      ),
     *       @OA\Response(
     *          response=200,
     *          description="Ok",
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse"),
     *       ),
     *       @OA\Response(response=422, description="Something went wrong."),
     *     )
     *
     * @return JsonResponse
     */
    public function google(): JsonResponse
    {
        return $this->social('google');
    }

    /**
     * @OA\Post (
     *      path="/auth/office",
     *      operationId="postOffice",
     *      tags={"auth"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AuthSocial")
     *      ),
     *       @OA\Response(
     *          response=200,
     *          description="Ok",
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse"),
     *       ),
     *       @OA\Response(response=422, description="Something went wrong."),
     *     )
     *
     * @return JsonResponse
     */
    public function office(): JsonResponse
    {
        return $this->social('office');
    }

    protected function social(string $type): JsonResponse
    {
        $socUser = Socialite::driver($type)->stateless()->user();
        $user = $this->socialRepository->createOrGetUser($socUser, $type);

        if (!$token = auth()->setTTL(config('jwt.ttl'))->login($user)) {
            return response()->json([
                'message' => 'Something went wrong.'
            ], 422);
        }

        $user->remember_token = $this->service->setTTL(config('jwt.social_refresh_ttl'))->fromUser($user);
        $user->save();

        return $this->userWithToken($user, $token);
    }
}

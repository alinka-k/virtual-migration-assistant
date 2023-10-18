<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserStatus;
use App\Events\Auth\Logout;
use App\Http\Controllers\ApiController;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\VerifyRequest;
use App\Models\Traits\Response\UserResourceWithToken;
use App\Models\User;
use App\Repositories\Contract\UserRepositoryContract;
use App\Repositories\UserRepository;
use App\Services\JwtTokenService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * @mixin  ValidatesRequests
 */
class MainController extends ApiController
{
    use SendsPasswordResetEmails;
    use VerifiesEmails;
    use UserResourceWithToken;

    /** @var UserRepository */
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @OA\Post (
     *      path="/auth/register",
     *      operationId="register",
     *      tags={"auth"},
     *      @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Registration")
     *      ),
     *      @OA\Response(
     *         response=200,
     *         description="OK",
     *      ),
     *      @OA\Response(response=403, description="Account is not created."),
     * )
     *
     * @param UserRegisterRequest $request
     * @return JsonResponse
     * @throws Throwable
     */
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->create($request->validated());
        if (!$user) {
            Log::info('User failed to register.', ['email' => $request->email]);
            return response()->json([
                'message' => 'Account is not created. Please, contact to administrator.'
            ], 422);
        }

        event(new Registered($user));

        return response()->json([
            'message' => 'Activation link was send to your email, please check it.'
        ]);
    }

    /**
     * @OA\Post (
     *      path="/auth/login",
     *      operationId="login",
     *      tags={"auth"},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/Login")
     *      ),
     *       @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\Header(
     *              header="Authorization",
     *              description="Authorization Key",
     *              @OA\Schema(
     *                  type="string"
     *              )
     *          ),
     *          @OA\Header(
     *              header="Access-Control-Expose-Headers",
     *              description="Accessed headers",
     *              @OA\Schema(
     *                  type="string"
     *              )
     *          ),
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse")
     *       ),
     *       @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     *
     * @param UserLoginRequest $request
     * @param JwtTokenService $service
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request, JwtTokenService $service): JsonResponse
    {
        $attemptData = Arr::add($request->only(['email', 'password']), 'status', UserStatus::Active);
        if (!$token = auth()->setTTL(config('jwt.ttl'))->attempt($request->only(['email', 'password']))) {
            return response()->json([
                'errors' => ['Credentials are wrong.']
            ], 422);
        } elseif (!$token = auth()->attempt($attemptData)) {
            return response()
                ->json([
                    'errors' => ['Your account is inactive.']
                ], 422);
        }
        $remember_ttl = config('jwt.remember_off_refresh_ttl');
        if ($request->get('staySignedIn')) {
            $remember_ttl = config('jwt.remember_on_refresh_ttl');
        }
        $user = User::firstWhere('email', $request->get('email'));
        $user->remember_token = $service->setTTL($remember_ttl)->fromUser($user);
        $user->save();

        return $this->userWithToken($request->user(), $token);
    }

    /**
     * @OA\Post (
     *      path="/auth/logout",
     *      operationId="logout",
     *      tags={"auth"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(response=200, description="OK")
     * )
     */
    public function logout(Request $request)
    {
        Logout::dispatch($request->user()->id);
        auth()->logout();
    }

    /**
     * @OA\Get (
     *      path="/auth/verify",
     *      operationId="verify",
     *      tags={"auth"},
     *      @OA\Parameter(name="expires", in="query", required=true),
     *      @OA\Parameter(name="hash", in="query", required=true),
     *      @OA\Parameter(name="id", in="query", required=true),
     *      @OA\Parameter(name="signature", in="query", required=true),
     *      @OA\Response(response=403, description="Forbidden Error"),
     *      @OA\Response(response=200, description="OK")
     * )
     * @param VerifyRequest $request
     * @return JsonResponse
     */
    public function verify(VerifyRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = $this->userRepository->findNotVerified($request->get('id'));

        if (!$user) {
            return new JsonResponse([
                'message' => 'Link is unavailable.',
            ], 403);
        }

        if (!hash_equals((string)$request->post('hash'), sha1($user->getEmailForVerification()))) {
            return new JsonResponse([
                'message' => 'Verification hash is broken.',
            ], 403);
        }

        if ($user->markEmailAsVerified() && $user->markStatusAsActive()) {
            event(new Verified($user));
        }

        return new JsonResponse([
            'message' => 'Account is verified.',
        ]);
    }

    /**
     * @OA\Get (
     *      path="/auth/refresh",
     *      operationId="refresh",
     *      tags={"auth"},
     *      security={{"bearerAuth":{}}},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\Header(
     *              header="Authorization",
     *              description="Authorization Key",
     *              @OA\Schema(type="string")
     *          ),
     *          @OA\Header(
     *              header="Access-Control-Expose-Headers",
     *              description="Accessed headers",
     *              @OA\Schema(type="string")
     *          ),
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse")
     *       ),
     *       @OA\Response(response=422, description="Unprocessable Entity"),
     * )
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $token = auth()->refresh();

        return (new JsonResponse())
            ->header('Access-Control-Expose-Headers', 'Authorization')
            ->header('Authorization', 'Bearer ' . $token);
    }

    /**
     * @OA\Get (
     *      path="/auth/forgot-password",
     *      operationId="forgotPassword",
     *      tags={"auth"},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse")
     *       ),
     *       @OA\Response(response=403, description="This email address is not registered"),
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $result = $this->userRepository->findByEmail($request->email);

        if ($result) {
            $this->broker()->sendResetLink(
                $this->credentials($request)
            );

            return response()->json([
                'message' => 'Password recovery email sent to you'
            ]);
        }

        return response()->json([
            'message' => 'This email address is not registered'
        ], 403);
    }
}

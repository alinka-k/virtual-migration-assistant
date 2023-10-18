<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use App\Http\Requests\ResetPasswordRequest;
use App\Models\CheckPasswordResets;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class ResetPassword extends ApiController
{
    use ResetsPasswords;
    private const SUCCESS_MESSAGE = 'Your password has been changed';

    /**
     * @OA\Post (
     *      path="/auth/reset-password",
     *      operationId="resetPassword",
     *      tags={"auth"},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse")
     *       ),
     *       @OA\Response(response=423, description="The given data was invalid"),
     * )
     * @param ResetPasswordRequest $request
     * @return RedirectResponse|JsonResponse
     * @throws ValidationException
     */
    public function reset(ResetPasswordRequest $request)
    {
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        if ($response == Password::PASSWORD_RESET) {
            return new JsonResponse(['message' => trans(ResetPassword::SUCCESS_MESSAGE)]);
        }

        throw ValidationException::withMessages([
            'email' => [trans($response)],
        ]);
    }

    /**
     * @OA\Post (
     *      path="/auth/reset-password/{token}/{email}",
     *      operationId="resetPassword",
     *      tags={"auth"},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent(ref="#/components/schemas/UserResourceResponse")
     *       ),
     * )
     * @param $token
     * @param $email
     * @return RedirectResponse|JsonResponse
     */
    public function checkUrl($token, $email)
    {
        $obj = CheckPasswordResets::where('email', $email)->get();
        foreach ($obj as $res) {
            $result = $res['email'];
        }
        if (!empty($result)) {
            return new JsonResponse(['message' => 'OK']);
        }

        return new JsonResponse(['message' => 'This URL is not valid'], 404);
    }
}

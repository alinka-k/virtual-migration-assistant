<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ThrottleRequestsException $e) {
            return response()->json(['errors' => ['throttle' => 'Server attempt error.']], 429);
        });
        $this->renderable(function (AuthenticationException $e) {
            return response()->json(['errors' => $this->getMessage($e)], 401);
        });
        $this->renderable(function (PermissionException $e) {
            return response()->json(['errors' => $this->getMessage($e)], $e->getCode());
        });
    }

    protected function getMessage(Throwable $exception): string
    {
        if (config('app.env') === 'production') {
            return 'Internal error. Please contact the administrator.';
        }
        return $exception->getMessage();
    }
}

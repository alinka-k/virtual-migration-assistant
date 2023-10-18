<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Exceptions\InvalidSignatureException;
use phpDocumentor\Reflection\Types\Boolean;

class ValidateSignature
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param Boolean $absolute
     * @return Response
     *
     */
    public function handle($request, Closure $next, $absolute)
    {
        if ($request->hasValidSignature(!!$absolute)) {
            return $next($request);
        }

        throw new InvalidSignatureException;
    }
}

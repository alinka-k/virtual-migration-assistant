<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionException;
use App\Services\Permissions\PermissionsService;
use Closure;
use Illuminate\Http\Request;

class Permission
{
    private PermissionsService $permissionsService;

    public function __construct(PermissionsService $permissionsService)
    {
        $this->permissionsService = $permissionsService;
    }

    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param $slug
     * @return mixed
     * @throws PermissionException
     */
    public function handle($request, Closure $next, $slug)
    {
        if ($this->permissionsService->isSatisfiedBy($request->user()->id, $slug)) {
            return $next($request);
        }

        throw new PermissionException();
    }
}

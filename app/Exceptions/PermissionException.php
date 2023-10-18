<?php

namespace App\Exceptions;

use App\Enums\Permission;
use Exception;
use Throwable;

class PermissionException extends Exception
{
    public function __construct($message = "", $code = 403, Throwable $previous = null)
    {
        Log::critical($message);
        parent::__construct(Permission::Error, $code, $previous);
    }
}

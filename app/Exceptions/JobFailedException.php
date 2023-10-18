<?php

namespace App\Exceptions;

use Exception;

class JobFailedException extends Exception
{
    protected $code = 500;
}

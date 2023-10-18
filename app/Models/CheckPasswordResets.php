<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperCheckPasswordResets
 */
class CheckPasswordResets extends Model
{
    protected $table = 'password_resets';
}

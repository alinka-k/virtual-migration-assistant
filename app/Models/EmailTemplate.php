<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperEmailTemplate
 */
class EmailTemplate extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];
}

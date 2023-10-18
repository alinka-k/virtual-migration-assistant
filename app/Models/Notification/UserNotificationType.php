<?php

namespace App\Models\Notification;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserNotificationType
 */
class UserNotificationType extends Model
{
    protected $fillable = [
        'express_entry',
        'all_programs',
        'lawyer_consultation',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

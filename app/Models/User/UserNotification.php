<?php

namespace App\Models\User;

use App\Events\Notification\NewUserNotification;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserNotification
 */
class UserNotification extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'body',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $dispatchesEvents = [
      'saved' => NewUserNotification::class,
    ];
}

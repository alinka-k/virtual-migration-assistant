<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUsersCanadianRelative
 */
class UsersCanadianRelative extends Model
{
    protected $fillable = [
        'has_friend_mb',
        'has_relatives',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(UsersCanadianRelativeItem::class, 'relative_id');
    }
}

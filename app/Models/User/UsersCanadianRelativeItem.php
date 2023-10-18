<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUsersCanadianRelativeItem
 */
class UsersCanadianRelativeItem extends Model
{
    protected $fillable = [
        'relationship',
        'canadian_status',
        'province',
        'residency_duration'
    ];

    public function relative()
    {
        return $this->belongsTo(UsersCanadianRelative::class, 'relative_id_foreign');
    }
}

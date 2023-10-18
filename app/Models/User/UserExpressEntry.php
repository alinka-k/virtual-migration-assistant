<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserExpressEntry
 */
class UserExpressEntry extends Model
{
    protected $fillable = [
        'existing_profile',
        'invitation_received',
    ];

    protected $casts = [
        'existing_profile' => 'boolean',
        'invitation_received' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

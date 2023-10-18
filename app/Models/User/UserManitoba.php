<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserManitoba
 */
class UserManitoba extends Model
{
    protected $fillable = [
        'strategic_recruitment_invitation'
    ];

    protected $table = 'user_manitoba';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserComment
 */
class UserComment extends Model
{
    protected $fillable = [
        'has_comments',
        'comments',
    ];

    protected $table = 'user_comment';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

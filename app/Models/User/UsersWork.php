<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property boolean $no_more_works
 * @property boolean $has_work_experience_10_yr
 * @property boolean $qualification_certificate
 * @property string $created_at
 * @property string $updated_at
 * @mixin IdeHelperUsersWork
 */
class UsersWork extends Model
{
    protected $fillable = [
        'has_work_experience_10_yr',
        'qualification_certificate',
        'no_more_works'
    ];

    protected $casts = [
        'has_work_experience_10_yr' => 'boolean',
        'qualification_certificate' => 'boolean',
    ];

    protected $table = 'users_work';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function histories()
    {
        return $this->hasMany(UsersWorkHistory::class, 'work_id');
    }
}

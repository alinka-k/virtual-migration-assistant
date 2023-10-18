<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserNetWorth
 */
class UserNetWorth extends Model
{
    protected $fillable = [
        'net_worth',
        'currency',
    ];

    protected $table = 'user_net_worth';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

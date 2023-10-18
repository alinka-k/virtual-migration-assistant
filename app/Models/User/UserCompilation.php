<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserCompilation extends Model
{
    protected $table = 'users_compilation';

    protected $fillable = [
        'compilation_data',
        'percent',
        'can_profile_be_evaluated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

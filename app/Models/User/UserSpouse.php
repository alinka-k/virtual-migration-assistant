<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserSpouse
 */
class UserSpouse extends Model
{
    protected $fillable = [
        'age',
        'education_level',
        'english',
        'french',
        'has_foreign_work',
        'foreign_exp_years',
        'has_canadian_work',
        'canadian_exp_years',
    ];

    protected $table = 'users_spouse';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

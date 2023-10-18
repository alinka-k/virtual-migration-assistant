<?php

namespace App\Models\User;

use App\Models\User;
use DateTime;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_id
 * @property string $title
 * @property string $dob
 * @property string $residence_country
 * @property string $destination_province
 * @property integer $stay_in_quebec
 * @property string $stay_in_quebec_duration
 * @property string $manitoba_city_preference
 * @property string $marital_status
 * @property integer $has_children
 * @property string $children_0_12
 * @property string $children_13_18
 * @property string $created_at
 * @property string $updated_at
 * @mixin IdeHelperUserProfile
 */
class UserProfile extends Model
{
    protected $fillable = [
        'title',
        'dob',
        'residence_country',
        'destination_province',
        'stay_in_quebec',
        'stay_in_quebec_duration',
        'manitoba_city_preference',
        'marital_status',
        'has_children',
        'children_0_12',
        'children_13_18',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAgeAttribute()
    {
        $dob = new DateTime($this->dob);
        $diff = $dob->diff(new DateTime());
        return $diff->format('%y');
    }

    public function isUserMarried(): bool
    {
        return $this->marital_status === 'married';
    }
}

<?php

namespace App\Models\User;

use App\Models\FuturePlanPrograms;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperUserFuturePlans
 */
class UserFuturePlans extends Model
{
    protected $fillable = [
        'is_graduation',
        'program_id',
        'graduation_date',
        'is_user_program',
        'user_program',
        'is_currently_employed',
        'is_interested_in_study',
        'desired_study',
        'type_program',
        'investment',
        'has_required_budget',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(FuturePlanPrograms::class);
    }

    public function save(array $options = [])
    {
        $this->program_id = empty($this->program_id) ? null : $this->program_id;
        parent::save($options);
    }
}

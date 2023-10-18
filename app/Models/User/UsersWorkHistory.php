<?php

namespace App\Models\User;

use App\Enums\Location;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property integer $id
 * @property integer $work_id
 * @property string $occupation
 * @property string $noc
 * @property float $duration
 * @property string $when
 * @property string $schedule_type
 * @property string $work_type
 * @property string $location
 * @property string $province
 * @property string $related_to_study_field
 * @property string $work_permit
 * @property boolean $full_ownership
 * @property string $created_at
 * @property string $updated_at
 * @property string $start_date
 * @mixin IdeHelperUsersWorkHistory
 */
class UsersWorkHistory extends Model
{
    protected $fillable = [
        'occupation',
        'noc',
        'duration',
        'when',
        'schedule_type',
        'work_type',
        'location',
        'province',
        'related_to_study_field',
        'work_permit',
        'full_ownership',
        'start_date'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(UsersWork::class);
    }

    public function scopeOther(Builder $query): Builder
    {
        return $query->where('location', Location::Other);
    }
}

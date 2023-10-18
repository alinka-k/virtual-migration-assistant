<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperUsersEducationItem
 */
class UsersEducationItem extends Model
{
    protected $fillable = [
        'type_of_program',
        'duration',
        'completed',
        'location',
        'province',
        'institution',
        'program_name',
        'field_of_study',
        'completion_date',
        'mb_field_in_steam',
        'mb_steam_internship',
        'mb_bridging_program',
        'resided_16_months_in_atlantic_province'
    ];

    public function education(): BelongsTo
    {
        return $this->belongsTo(UsersEducation::class, 'education_id_foreign');
    }
}

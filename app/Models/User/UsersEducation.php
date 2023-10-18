<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperUsersEducation
 */
class UsersEducation extends Model
{
    protected $fillable = [
        'highschool_completed',
        'has_post_secondary_education',
        'no_more_diplomas'
    ];

    protected $casts = [
        'highschool_completed' => 'boolean',
        'has_post_secondary_education' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(UsersEducationItem::class, 'education_id');
    }
}

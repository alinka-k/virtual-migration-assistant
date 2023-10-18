<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User $user
 * @mixin IdeHelperUserCanadianJobOffer
 */
class UserCanadianJobOffer extends Model
{
    protected $fillable = [
        'has_offer',
        'occupation',
        'province',
        'district',
        'in_bc_northeast_development_region',
        'wage',
        'duration',
        'schedule_type',
        'from_current_employer',
        'has_lmia_approved',
        'is_lmia_except',
        'is_related_to_study',
        'related_experience_years',
        'bc_industry_training_authority_certificate',
        'ab_related_edu_or_experience',
        'ab_child_care_experience',
        'sask_1a_driver_licence',
        'ns_health_authority',
        'mb_invitation_to_apply',
        'atlantic_pilot_registered_employer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

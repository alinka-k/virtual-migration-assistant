<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $program_id
 * @property string $label
 * @property boolean $status
 * @property string $type
 * @property string $tracker
 * @mixin IdeHelperEligibilityProgram
 */
class EligibilityProgram extends Model
{
    protected $fillable = [
        'program_id',
        'label',
        'status',
        'type',
        'tracker',
    ];
}

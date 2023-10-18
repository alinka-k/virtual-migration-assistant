<?php

namespace App\Models\Evaluate;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Notifications\Notifiable;

/**
 * @property string $status
 * @property string $token
 * @property array $eligibilityFormatted
 * @property array $fswLogFormatted
 * @property array $fswCrsLogFormatted
 * @property int $user_id
 * @property int $virtual_profile_id
 * @property int $fsw
 * @property int $crs
 * @property string $fsw_log
 * @property string $fsw_crs_log
 * @property string $result
 * @property boolean $has_high_crs
 * @property string $payload
 * @property string $response
 * @property string $eligibility
 * @property boolean $fsw_passed
 * @property boolean $cec_passed
 * @property boolean $fst_passed
 * @property User $user
 * @property EvaluationPoint $points
 * @mixin IdeHelperEvaluation
 */
class Evaluation extends Model
{
    use Notifiable;

    protected $fillable = [
        'status',
        'token',
        'fsw',
        'crs',
        'fsw_log',
        'fsw_crs_log',
        'result',
        'has_high_crs',
        'payload',
        'response',
        'eligibility',
        'fsw_passed',
        'fst_passed',
        'cec_passed',
    ];

    public function routeNotificationForMail($notification): array
    {
        return [$this->user->email => $this->user->name];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getEligibilityFormattedAttribute($value): array
    {
        return array_keys(json_decode($this->eligibility, true) ?: []);
    }

    public function getFswLogFormattedAttribute($value): array
    {
        return json_decode($this->fsw_log, true) ?: [];
    }

    public function getFswCrsLogFormattedAttribute($value): array
    {
        return json_decode($this->fsw_crs_log, true) ?: [];
    }

    public function points(): HasOne
    {
        return $this->hasOne(EvaluationPoint::class);
    }

    public static function getAvailableFields(): array
    {
        return [
            'status' => 'Status',
            'fsw' => 'fsw',
            'crs' => 'crs',
            'result' => 'Result',
            'eligibility' => 'Eligibility program',
        ];
    }
}

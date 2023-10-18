<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $view
 * @property Evaluation $evaluation
 * @mixin IdeHelperEvaluationPoint
 */
class EvaluationPoint extends Model
{
    protected $fillable = [
        'view',
        'fsw',
        'crs',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function getViewFormattedAttribute($value): array
    {
        return json_decode($this->fsw_log, true) ?: [];
    }
}

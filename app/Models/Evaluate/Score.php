<?php

namespace App\Models\Evaluate;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $fsw
 * @property string $crs
 * @property string $response
 * @mixin IdeHelperScore
 */
class Score extends Model
{
    protected $fillable = [
        'fsw',
        'crs',
        'response',
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
}

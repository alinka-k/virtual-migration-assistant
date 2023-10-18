<?php

namespace App\Models\VirtualProfile;

use Illuminate\Database\Eloquent\Model;

/**
 * Class VirtualCanadianRelativeItem
 * @package App\Models\VirtualProfile
 */
class VirtualCanadianRelativeItem extends Model
{
    protected $fillable = [
        'relationship',
        'canadian_status',
        'province',
        'residency_duration'
    ];

    public $timestamps = false;

    public function relative()
    {
        return $this->belongsTo(VirtualRelative::class, 'relative_id_foreign');
    }
}

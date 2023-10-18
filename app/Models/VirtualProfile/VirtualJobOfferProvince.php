<?php

namespace App\Models\VirtualProfile;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperVirtualJobOfferProvince
 */
class VirtualJobOfferProvince extends Model
{
    protected $fillable = [
        'province'
    ];

    public $timestamps = false;

    public function jobOffer()
    {
        return $this->belongsTo(VirtualJobOffer::class);
    }
}

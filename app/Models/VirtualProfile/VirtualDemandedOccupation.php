<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperVirtualDemandedOccupation
 */
class VirtualDemandedOccupation extends Model implements VirtualSaveInterface
{
    use VirtualSaveTrait;

    protected $fillable = [
        'occupation',
        'inside',
        'outside'
    ];

    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo(VirtualProfile::class);
    }
}

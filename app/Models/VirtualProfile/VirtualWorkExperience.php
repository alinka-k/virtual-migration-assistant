<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * @property float $noc_0
 * @property float $noc_A
 * @property float $noc_B
 * @property float $noc_C_D
 * @mixin IdeHelperVirtualWorkExperience
 */
class VirtualWorkExperience extends Model implements VirtualSaveInterface
{
    use VirtualSaveTrait;

    protected $fillable = [
        'noc_0',
        'noc_A',
        'noc_B',
        'noc_C_D',
    ];

    protected $table = 'virtual_work_experience';

    public function profile()
    {
        return $this->belongsTo(VirtualProfile::class);
    }
}

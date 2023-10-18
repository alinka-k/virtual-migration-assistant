<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * @property VirtualProfile $profile
 * @property integer $id
 * @property integer $virtual_profiles_id
 * @property integer $net_worth
 * @property string $currency
 * @property integer $business_owner_experience
 * @property integer $senior_manager_experience
 * @mixin IdeHelperVirtualEntrepreneurship
 */
class VirtualEntrepreneurship extends Model implements VirtualSaveInterface
{
    use VirtualSaveTrait;

    protected $fillable = [
        'net_worth', 'business_owner_experience', 'senior_manager_experience', 'currency'
    ];

    protected $table = 'virtual_entrepreneurship';

    public function profile()
    {
        return $this->belongsTo(VirtualProfile::class);
    }
}

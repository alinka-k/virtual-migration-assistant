<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $occupation
 * @property string $duration
 * @property string $when
 * @property string $province
 * @property VirtualProfile $profile
 * @mixin IdeHelperVirtualCanadianWorkItem
 */
class VirtualCanadianWorkItem extends Model implements VirtualSaveInterface
{
    protected $fillable = [
        'occupation',
        'duration',
        'when',
        'province',
        'work_permit',
        'location',
        'schedule_type',
        'work_type',
    ];

    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo(VirtualProfile::class);
    }

    public static function loadAndSave($virtual_id, $data)
    {
        self::where('virtual_profile_id', $virtual_id)->delete();
        foreach ($data as $item) {
            $model = new self();
            $model->fill($item);
            (VirtualProfile::firstWhere(['id' => $virtual_id]))->workInsideCanada()->save($model);
        }
    }
}

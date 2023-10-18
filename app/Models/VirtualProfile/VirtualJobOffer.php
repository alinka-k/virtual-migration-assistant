<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * @mixin IdeHelperVirtualJobOffer
 */
class VirtualJobOffer extends Model implements VirtualSaveInterface
{
    protected $fillable = [
        'occupation', 'duration'
    ];

    public $timestamps = false;

    public function profile()
    {
        return $this->belongsTo(VirtualProfile::class);
    }

    public function provinces()
    {
        return $this->hasMany(VirtualJobOfferProvince::class);
    }

    public static function loadAndSave($virtual_id, $data)
    {
        $model = static::firstOrNew(['virtual_profile_id' => $virtual_id]);
        if ($model) {
            $model->fill($data);
            $model->virtual_profile_id = $virtual_id;
            $model->save();

            $model->provinces()->delete();
            $province = Arr::get($data, 'province');
            $provinceRecord = new VirtualJobOfferProvince(['province' => $province ?: null]);
            $model->provinces()->save($provinceRecord);
        }
    }
}

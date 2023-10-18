<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $virtual_profile_id
 * @property float $english
 * @property float $french
 * @property VirtualSpouseInsideExperience $inside
 * @property VirtualSpouseOutsideExperience $outside
 * @mixin IdeHelperVirtualSpouse
 */
class VirtualSpouse extends Model implements VirtualSaveInterface
{
    protected $fillable = [
        'english',
        'french',
    ];

    protected $table = 'virtual_spouse';

    public function profile()
    {
        return $this->belongsTo(VirtualProfile::class);
    }

    public function inside()
    {
        return $this->hasOne(VirtualSpouseInsideExperience::class);
    }

    public function outside()
    {
        return $this->hasOne(VirtualSpouseOutsideExperience::class);
    }

    public static function loadAndSave($virtual_id, $data)
    {
        $model = static::firstOrNew(['virtual_profile_id' => $virtual_id]);
        if ($model) {
            $model->fill($data);
            $model->virtual_profile_id = $virtual_id;
            $model->save();
        }

        $model->inside()->delete();
        $model->outside()->delete();

        $inside = new VirtualSpouseInsideExperience($data['inside']);
        $outside = new VirtualSpouseOutsideExperience($data['outside']);

        $resultInside = $model->inside()->save($inside);
        $resultOutside = $model->outside()->save($outside);

        return $resultInside && $resultOutside;
    }
}

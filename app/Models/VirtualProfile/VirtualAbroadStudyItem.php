<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $type_of_program
 * @property string $duration
 * @property VirtualProfile $profile
 * @mixin IdeHelperVirtualAbroadStudyItem
 */
class VirtualAbroadStudyItem extends Model implements VirtualSaveInterface
{
    protected $fillable = [
        'type_of_program',
        'duration',
    ];

    protected $hidden = ['id', 'virtual_profile_id'];

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
            (VirtualProfile::firstWhere(['id' => $virtual_id]))->studyOutsideCanada()->save($model);
        }
    }
}

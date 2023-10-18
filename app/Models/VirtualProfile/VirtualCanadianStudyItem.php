<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $type_of_program
 * @property string $duration
 * @property bool $completed
 * @property string $location
 * @property string $province
 * @property string $institution
 * @property string $program_name
 * @property string $field_of_study
 * @property string $completion_date
 * @property string $mb_field_in_steam
 * @property string $mb_steam_internship
 * @property string $mb_bridging_program
 * @property bool $resided_16_months_in_atlantic_province
 * @property VirtualProfile $profile
 * @mixin IdeHelperVirtualCanadianStudyItem
 */
class VirtualCanadianStudyItem extends Model implements VirtualSaveInterface
{
    protected $fillable = [
        'type_of_program',
        'duration',
        'completed',
        'location',
        'province',
        'institution',
        'program_name',
        'field_of_study',
        'completion_date',
        'mb_field_in_steam',
        'mb_steam_internship',
        'mb_bridging_program',
        'resided_16_months_in_atlantic_province',
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
            $model->completed = true;
            $model->location = 'Canada';
            (VirtualProfile::firstWhere(['id' => $virtual_id]))->studyInsideCanada()->save($model);
        }
    }
}

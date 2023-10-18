<?php

namespace App\Models\VirtualProfile;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $type_of_program
 * @property string $duration
 * @property float $noc_0
 * @property float $noc_A
 * @property float $noc_B
 * @property float $noc_C_D
 * @property string $province
 * @mixin IdeHelperVirtualSpouseInsideExperience
 */
class VirtualSpouseInsideExperience extends Model
{
    protected $fillable = [
        'noc_0',
        'noc_A',
        'noc_B',
        'noc_C_D',
        'type_of_program',
        'duration',
        'province',
    ];

    protected $table = 'virtual_spouse_inside_canada_experience';

    public function spouse()
    {
        return $this->belongsTo(VirtualSpouse::class);
    }

    public function setDurationAttribute($value)
    {
        $this->attributes['duration'] = json_encode($value ?? []);
    }

    public function setTypeOfProgramAttribute($value)
    {
        $this->attributes['type_of_program'] = json_encode($value ?? []);
    }

    public function setProvinceAttribute($value)
    {
        $this->attributes['province'] = json_encode($value ?? []);
    }
}

<?php

namespace App\Models;

use App\Models\Evaluate\Evaluation;
use App\Models\VirtualProfile\VirtualAbroadStudyItem;
use App\Models\VirtualProfile\VirtualCanadianStudyItem;
use App\Models\VirtualProfile\VirtualCanadianWorkItem;
use App\Models\VirtualProfile\VirtualDemandedOccupation;
use App\Models\VirtualProfile\VirtualEntrepreneurship;
use App\Models\VirtualProfile\VirtualJobOffer;
use App\Models\VirtualProfile\VirtualLanguage;
use App\Models\VirtualProfile\VirtualRelative;
use App\Models\VirtualProfile\VirtualSpouse;
use App\Models\VirtualProfile\VirtualWorkExperience;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_id
 * @property string $name
 * @property boolean $saved
 * @property User $user
 * @property VirtualCanadianWorkItem[] $workInsideCanada
 * @property VirtualDemandedOccupation $demandedOccupation
 * @property VirtualEntrepreneurship $entrepreneurship
 * @property VirtualJobOffer $jobOffer
 * @property VirtualLanguage $languages
 * @property VirtualRelative $relative
 * @property VirtualSpouse $spouse
 * @property VirtualWorkExperience $workExperience
 * @property VirtualCanadianStudyItem[] $studyInsideCanada
 * @property VirtualAbroadStudyItem[] $studyOutsideCanada
 */
class VirtualProfile extends Model
{
    const SAVED = 1;
    const NOT_SAVED = 0;

    protected $fillable = [
        'name', 'saved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSaved($query)
    {
        return $query->where('saved', self::SAVED);
    }

    public function studyInsideCanada()
    {
        return $this->hasMany(VirtualCanadianStudyItem::class);
    }

    public function studyOutsideCanada()
    {
        return $this->hasMany(VirtualAbroadStudyItem::class);
    }

    public function workInsideCanada()
    {
        return $this->hasMany(VirtualCanadianWorkItem::class);
    }

    public function demandedOccupation()
    {
        return $this->hasOne(VirtualDemandedOccupation::class);
    }

    public function entrepreneurship()
    {
        return $this->hasOne(VirtualEntrepreneurship::class);
    }

    public function jobOffer()
    {
        return $this->hasOne(VirtualJobOffer::class);
    }

    public function languages()
    {
        return $this->hasMany(VirtualLanguage::class);
    }

    public function relative()
    {
        return $this->hasOne(VirtualRelative::class);
    }

    public function spouse()
    {
        return $this->hasOne(VirtualSpouse::class);
    }

    public function workExperience()
    {
        return $this->hasOne(VirtualWorkExperience::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class)->latest();
    }
}

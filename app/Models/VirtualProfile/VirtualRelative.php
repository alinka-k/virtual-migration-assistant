<?php

namespace App\Models\VirtualProfile;

use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * @mixin IdeHelperVirtualRelative
 */
class VirtualRelative extends Model implements VirtualSaveInterface
{
    protected $fillable = [
        'has_friend_mb',
        'has_relatives',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(VirtualProfile::class);
    }

    public function items()
    {
        return $this->hasMany(VirtualCanadianRelativeItem::class, 'relative_id');
    }

    public static function loadAndSave($virtual_id, $data)
    {
        $model = static::firstOrNew(['virtual_profile_id' => $virtual_id]);
        if ($model) {
            $model->fill($data);
            $model->virtual_profile_id = $virtual_id;
            $model->save();
            $items = Arr::get($data, 'relativesItems');
            $model->items()->delete();
            if ($model->has_relatives) {
                foreach ($items as $item) {
                    $relativeItem = new VirtualCanadianRelativeItem($item);
                    $model->items()->save($relativeItem);
                }
            }
        }
    }
}

<?php

namespace App\Models\VirtualProfile;

trait VirtualSaveTrait
{
    public static function loadAndSave($virtual_id, $data)
    {
        $model = static::firstOrNew(['virtual_profile_id' => $virtual_id]);
        if ($model) {
            $model->fill($data);
            $model->virtual_profile_id = $virtual_id;
            return $model->save();
        }
        return false;
    }
}

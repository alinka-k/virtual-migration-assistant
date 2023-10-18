<?php

namespace App\Models\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $user_id
 * @property string image_origin
 * @property string image_crop
 * @property string $created_at
 * @property string $updated_at
 * @mixin IdeHelperUserImage
 */
class UserImage extends Model
{
    protected $fillable = [
        'image_origin',
        'image_crop',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

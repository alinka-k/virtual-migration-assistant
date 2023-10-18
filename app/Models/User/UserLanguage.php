<?php

namespace App\Models\User;

use App\Models\User;
use Arr;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $user_id
 * @property string $language_type
 * @property boolean $has_test
 * @property string $language_test
 * @property string $language_date
 * @property string $writing
 * @property integer $reading
 * @property string $speaking
 * @property string $listening
 * @property float $clb
 * @property string $created_at
 * @property string $updated_at
 * @property string $writing_test
 * @property string $reading_test
 * @property string $speaking_test
 * @property string $listening_test
 * @mixin IdeHelperUserLanguage
 */
class UserLanguage extends Model
{
    protected $fillable = [
        'language_type',
        'has_test',
        'language_test',
        'language_date',
        'writing_test',
        'reading_test',
        'speaking_test',
        'listening_test',
        'writing',
        'reading',
        'speaking',
        'listening',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fillRegardingTest($model)
    {
        if (Arr::get($model, 'language_test')) {
            $this->fill([
                'writing_test' => Arr::get($model, 'writing'),
                'reading_test' => Arr::get($model, 'reading'),
                'speaking_test' => Arr::get($model, 'speaking'),
                'listening_test' => Arr::get($model, 'listening'),
                'language_test' => Arr::get($model, 'language_test'),
            ]);
        } else {
            $this->fill($model);
        }
    }
}

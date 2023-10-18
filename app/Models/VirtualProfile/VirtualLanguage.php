<?php

namespace App\Models\VirtualProfile;

use App\Models\User;
use App\Models\VirtualProfile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

/**
 * @property VirtualProfile $profile
 * @property integer $id
 * @property string $language_type
 * @property string $language_test
 * @property float $clb
 * @property float $writing
 * @property float $reading
 * @property float $speaking
 * @property float $listening
 * @mixin IdeHelperVirtualLanguage
 */
class VirtualLanguage extends Model implements VirtualSaveInterface
{
    protected $fillable = [
        'language_type',
        'language_test',
        'clb',
        'writing',
        'reading',
        'speaking',
        'listening',
    ];

    public function profile()
    {
        return $this->belongsTo(VirtualProfile::class);
    }

    public static function loadAndSave($virtual_id, $data)
    {
        try {
            $user = User::where('id', VirtualProfile::firstWhere('id', $virtual_id)->user_id)->first();
            $skills = ['listening', 'writing', 'reading', 'speaking'];

            foreach ($user->languages as $profileLanguage) {
                $languageType = $profileLanguage->language_type;
                $result = ['language_type' => $languageType];
                $result['language_test'] = $profileLanguage['language_test'];
                $result['clb'] = $data[$languageType]['clb'];

                $model = static::firstOrNew([
                    'virtual_profile_id' => $virtual_id,
                    'language_type' => $languageType,
                ]);

                $virtualLanguage = array_filter($data, function ($virtType) use ($languageType) {
                    return $virtType === $languageType;
                }, ARRAY_FILTER_USE_KEY);
                foreach ($skills as $skill) {
                    $skillWithTest = $skill . '_test';
                    $profileSkill = $profileLanguage['has_test']
                        ? $profileLanguage->$skillWithTest
                        : $profileLanguage->$skill;
                    $virtualSkill = $virtualLanguage[$languageType][$skill];

                    $result[$skill] = $profileSkill <= $virtualSkill ? $virtualSkill : $profileSkill;
                }

                $model->fill($result);
                $model->virtual_profile_id = $virtual_id;
                $model->save();
            }
        } catch (\Exception $e) {
            Log::critical($e);
        }
    }
}

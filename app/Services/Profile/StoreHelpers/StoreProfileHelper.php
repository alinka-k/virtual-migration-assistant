<?php

namespace App\Services\Profile\StoreHelpers;

use App\Http\Requests\User\UserPersonalRequest;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class StoreProfileHelper implements StoreHelper
{
    public static function saveUserData(UserPersonalRequest $request): bool
    {
        try {
            DB::transaction(function () use ($request) {
                $profileData = $request->validated();
                $profile = $request->user()->profile()->firstOrNew();
                $profile->fill($profileData);

                if (empty($request->marital_status) || $request->marital_status === 'single') {
                    $request->user()->spouse()->delete();
                }

                if ($request->destination_province !== 'Manitoba') {
                    $profile->manitoba_city_preference = null;
                    $request->user()->manitoba()->delete();
                }

                if ($request->destination_province !== 'Quebec') {
                    $profile->stay_in_quebec = null;
                    $profile->stay_in_quebec_duration = null;
                }

                if ($request->destination_province === 'Quebec' && !$request->stay_in_quebec) {
                    $profile->stay_in_quebec_duration = null;
                }

                if (!$request->has_children) {
                    $profile->children_0_12 = null;
                    $profile->children_13_18 = null;
                }

                $request->user()->profile()->save($profile);

                $userFilteredFields = Arr::where($request->validated(), fn ($value, $key) => in_array($key, [
                    'first_name',
                    'last_name',
                    'phone',
                ]));
                $request->user()->fill($userFilteredFields)->save();
            });
            return true;
        } catch (Exception $e) {
            \Log::debug($e);
        }
        return false;
    }
}

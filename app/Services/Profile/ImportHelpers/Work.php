<?php

namespace App\Services\Profile\ImportHelpers;

use App\Models\User;
use App\Models\User\UsersWorkHistory;
use App\Services\SkilledOccupationChecker;
use Illuminate\Support\Carbon;
use Arr;

class Work implements ParseProfileInterface
{
    public static function loadAndSaveProfileInfo(User $user, $data): bool
    {
        $workData = self::prepareDataToFill($data);
        if (!$workData) {
            return true;
        }
        if ($user->work) {
            $user->work->delete();
        }
        $model = $user->work()->firstOrNew();
        $model->fill($workData);

        if (!$model->save()) {
            return false;
        }

        foreach (Arr::get($workData, 'history', []) as $item) {
            $prepareItem = self::prepareItemDataToFill($item);

            if (Arr::get($prepareItem, 'noc') === null) {
                continue;
            }

            if ((int)Arr::get($prepareItem, 'duration_years') === 0) {
                continue;
            }

            $workModel = new UsersWorkHistory();
            $workModel->fill($prepareItem);
            if (!$model->histories()->save($workModel)) {
                return false;
            }
        }
        return true;
    }

    public static function prepareDataToFill($data): array
    {
        return Arr::get($data, 'work', []) ?? [];
    }

    private static function prepareItemDataToFill($item)
    {
        if (isset($item['duration_years'])) {
            $item['duration'] = Arr::get($item, 'duration_years');
        }

        if (isset($item['end_date'])) {
            $item['when'] = Carbon::now()->diffInYears(Carbon::parse(Arr::get($item, 'end_date')));
        }

        $item['location'] = Arr::get($item, 'location', 'null');
        $item['skilled'] = (new SkilledOccupationChecker())->isSkilled(Arr::get($item, 'noc', ''));

        return $item;
    }
}

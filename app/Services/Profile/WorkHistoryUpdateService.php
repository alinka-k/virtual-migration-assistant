<?php

namespace App\Services\Profile;

use App\Enums\WorkDuration;
use App\Models\User\UsersWorkHistory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class WorkHistoryUpdateService
{
    public function process(): bool
    {
        $works = UsersWorkHistory::where([
            ['start_date', 'like', '%-' . date('m')],
            ['when', '=', '0'],
        ])->get();

        DB::transaction(function () use ($works) {
            foreach ($works as $work) {
                $years = self::getDurationByStartDate($work->start_date);
                if ($work->duration < $years) {
                    $work->duration = $years;
                    $work->save();
                }
            }
        });

        return true;
    }

    public static function getDurationByStartDate($start_date): string
    {
        $start = Carbon::parse($start_date);
        if (!$start) {
            \Log::error('Unexpected date format: ' . $start_date);
        }
        $now = Carbon::now();
        $now->diffInMonths($start);
        $months = $now->diffInMonths($start);
        if ($months < 12) {
            if (in_array(round($months / 12, 2), range(0.1, 0.24, 0.01))) {
                return WorkDuration::lessThanThreeMonths;
            }
            if (in_array(round($months / 12, 2), range(0.25, 0.4, 0.01))) {
                return WorkDuration::threeMonths;
            }
            if (in_array(round($months / 12, 2), range(0.5, 0.74, 0.01))) {
                return WorkDuration::sixMonths;
            }
            if (in_array(round($months / 12, 2), range(0.75, 0.9, 0.01))) {
                return WorkDuration::nineMonths;
            }
        }

        return $now->diffInYears($start);
    }
}

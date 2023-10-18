<?php

namespace App\Services;

use Illuminate\Support\Carbon;

class DateService
{
    public function getNotificationTime(string $date) : string
    {
        $carbonDate = Carbon::parse($date);
        $interval = $carbonDate->diffInMinutes();
        if ($interval >= 60 * 24) {
            return $carbonDate->format('Y-m-d H:i:s');
        }
        if ($interval > 60) {
            return $carbonDate->diffForHumans([
                'parts' => 2,
            ]);
        }
        if ((int) $interval === 0) {
            return 'Now';
        }
        return $carbonDate->diffForHumans();
    }
}

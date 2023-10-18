<?php

namespace App\Services\Profile;

use App\Enums\JobType;
use App\Services\Points\Programs\Helpers\WorkHelper;
use Arr;
use Illuminate\Database\Eloquent\Collection;

class WorkHistoryNocCalculator
{
    const NOC_PREFIX = 'noc_';
    private static array $skilledJobs = [JobType::NOC_0, JobType::NOC_A, JobType::NOC_B];
    private static array $semiSkilledJobs = [JobType::NOC_C, JobType::NOC_D];

    protected Collection $histories;

    public function __construct(Collection $histories)
    {
        $this->histories = $histories;
    }

    public function calculateNoc(): array
    {
        $result = [
            self::NOC_PREFIX . JobType::NOC_0 => null,
            self::NOC_PREFIX . JobType::NOC_A => null,
            self::NOC_PREFIX . JobType::NOC_B => null,
            self::NOC_PREFIX . JobType::NOC_C_D => null,
        ];

        $this->histories->each(function ($job) use (&$result) {
            $type = WorkHelper::getTypeOfWork(Arr::get($job, 'noc', ''));

            if (in_array($type[0], self::$skilledJobs)) {
                $result[self::NOC_PREFIX . $type[0]] += $job->duration;
            }

            if (in_array($type[0], self::$semiSkilledJobs)) {
                $result[self::NOC_PREFIX . JobType::NOC_C_D] += $job->duration;
            }
        });

        return array_map(fn ($item) => is_null($item) ? null : round($item), $result);
    }
}

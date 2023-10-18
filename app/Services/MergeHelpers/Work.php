<?php

namespace App\Services\MergeHelpers;

use App\Enums\JobType;
use App\Enums\Location;
use App\Models\VirtualProfile;
use App\Services\MergeHelpers\Noc\NocInterface;
use App\Services\MergeHelpers\Noc\Noc0;
use App\Services\MergeHelpers\Noc\NocA;
use App\Services\MergeHelpers\Noc\NocB;
use App\Services\MergeHelpers\Noc\NocCD;
use App\Services\Points\Programs\Helpers\WorkHelper;
use Arr;
use Illuminate\Database\Eloquent\Collection;

class Work extends BaseHelper
{
    private const EMPTY_JOB = [
        'occupation' => 'null',
        'duration' => 'null',
        'when' => 'null',
        'province' => 'null',
        'schedule_type' => 'null',
        'work_type' => 'null',
    ];

    protected Collection $jobs;

    public function __construct(VirtualProfile $virtualProfile)
    {
        parent::__construct($virtualProfile);
        $this->jobs = $this->virtualProfile->user->work->histories()->other()->get();
    }

    public function handle(): array
    {
        $mergedItems = array_merge($this->generateInsideItems(), $this->generateOutsideItems());
        return [
            'has_work_experience_10_yr' => !empty($mergedItems),
            'qualification_certificate' => !empty($mergedItems),
            'history' => $mergedItems ?: [self::EMPTY_JOB],
        ];
    }

    private function generateInsideItems(): array
    {
        $jobs = [];
        foreach (Arr::get($this->virtualProfile, 'workInsideCanada') as $job) {
            $jobs[] = [
                'occupation' => $job->occupation === null ? 'null' : $job->occupation,
                'duration' => $job->duration === null ? 'null' : $job->duration,
                'when' => $job->when === null ? 'null' : $job->when,
                'province' => $job->province === null ? 'null' : $job->province,
                'schedule_type' => $job->schedule_type === null ? 'null' : $job->schedule_type,
                'work_type' => $job->work_type === null ? 'null' : $job->work_type,
                'location' => $job->location === null ? 'null' : $job->location,
                'work_permit' => $job->work_permit === null ? 'null' : $job->work_permit,
            ];
        }
        return $jobs;
    }

    private function generateOutsideItems(): array
    {
        $workExperience = $this->virtualProfile->workExperience;

        $items = $this->applyNoc(JobType::NOC_0, $workExperience->noc_0, new Noc0());
        $items = array_merge($items, $this->applyNoc(JobType::NOC_A, $workExperience->noc_A, new NocA()));
        $items = array_merge($items, $this->applyNoc(JobType::NOC_B, $workExperience->noc_B, new NocB()));
        return array_merge($items, $this->applyNoc([JobType::NOC_C, JobType::NOC_D], $workExperience->noc_C_D, new NocCD()));
    }

    private function applyNoc($nocType, ?float $nocValue, NocInterface $nocClass): array
    {
        $jobs = array_values($this->getJobsWithNoc($nocType));

        if (is_null($nocValue)) {
            return $jobs;
        }

        if (empty($jobs)) {
            return [
                $this->mergeWithEmptyJob([
                    'occupation' => $nocClass->getOccupation(),
                    'noc' => $nocClass->getNoc(),
                    'duration' => $nocValue,
                    'location' => Location::Other,
                    'schedule_type' => 'Full Time'
                ])
            ];
        }

        $sum = collect($jobs)->pluck('duration')->sum();
        // remove already included points
        $jobs[0]['duration'] += $nocValue - $sum;

        return $jobs;
    }

    private function getJobsWithNoc($noc): array
    {
        return $this->jobs->filter(function ($job) use ($noc) {
            $jobNoc = WorkHelper::getTypeOfWork(Arr::get($job, 'noc', ''));
            return is_array($noc) ?
                in_array($jobNoc, $noc) :
                ($jobNoc === $noc);
        })->toArray();
    }

    private function mergeWithEmptyJob($array): array
    {
        return array_merge(self::EMPTY_JOB, $array);
    }
}

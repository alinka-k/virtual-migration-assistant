<?php

namespace App\Services\Profile;

use App\Jobs\Evaluation\Evaluate as EvaluateJob;
use App\Repositories\ProfileRepository;

class BirthdayService
{
    protected ProfileRepository $profileRepository;

    public function __construct(ProfileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }

    public function process()
    {
        $profiles = $this->profileRepository->getWhere(
            [
                ['dob', 'like', date('%-m-d')],
            ]
        );

        foreach ($profiles as $profile) {
            EvaluateJob::dispatch((string)$profile->user_id);
        }

        return true;
    }
}

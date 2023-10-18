<?php

namespace App\Services;

use App\Models\VirtualProfile;
use App\Services\MergeHelpers\BaseHelper;
use App\Services\MergeHelpers\Comments;
use App\Services\MergeHelpers\Education;
use App\Services\MergeHelpers\ExpressEntry;
use App\Services\MergeHelpers\JobOffer;
use App\Services\MergeHelpers\Language;
use App\Services\MergeHelpers\Manitoba;
use App\Services\MergeHelpers\PersonalNetWorth;
use App\Services\MergeHelpers\PrincipalApplicant;
use App\Services\MergeHelpers\Profile;
use App\Services\MergeHelpers\Relatives;
use App\Services\MergeHelpers\Spouse;
use App\Services\MergeHelpers\Work;

class MergeService
{
    private VirtualProfile $profile;
    private array $helpers = [
        'principal_applicant' => PrincipalApplicant::class,
        'profile' => Profile::class,
        'language' => Language::class,
        'express_entry' => ExpressEntry::class,
        'comments' => Comments::class,
        'personal_net_worth' => PersonalNetWorth::class,
        'manitoba' => Manitoba::class,
        'spouse' => Spouse::class,
        'canadian_relatives' => Relatives::class,
        'work' => Work::class,
        'canadian_job_offer' => JobOffer::class,
        'education' => Education::class,
    ];

    public function __construct(VirtualProfile $profile)
    {
        $this->profile = $profile;
    }

    public function generate(): string
    {
        $result = [];

        foreach ($this->helpers as $key => $helper) {
            /** @var BaseHelper $helper */
            $service = new $helper($this->profile);
            $result[$key] = $service->handle();
        }

        return json_encode($result);
    }
}

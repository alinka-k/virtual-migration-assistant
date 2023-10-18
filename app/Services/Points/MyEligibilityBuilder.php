<?php

namespace App\Services\Points;

use App\Enums\ImmigrationScoreType;
use App\Models\MyEligibility\MyEligibilityPage;
use App\Models\User;
use Illuminate\Support\Arr;

class MyEligibilityBuilder
{
    private array $contentFactories;
    private GeneralMessageProvider $generalMessageProvider;

    public function __construct(
        FSWPFactory $FSWPFactory,
        CECFactory $CECFactory,
        FSTPFactory $FSTPFactory,
        GeneralMessageProvider $generalMessageProvider
    ) {
        $this->contentFactories = [$CECFactory, $FSWPFactory, $FSTPFactory];
        $this->generalMessageProvider = $generalMessageProvider;
    }

    public function build(User $user): ?MyEligibilityPage
    {
        $evaluation = $user->evaluations()->whereNull('virtual_profile_id')->get()->last();
        if(!$evaluation) {
            return null;
        }
        $crs = json_decode(Arr::get($evaluation->points, ImmigrationScoreType::CRS), true);
        $fsw = json_decode(Arr::get($evaluation->points, ImmigrationScoreType::FSW), true);

        if (empty($evaluation) || empty($crs) || empty($fsw)) {
            return null;
        }
        $myEligibilityPage = new MyEligibilityPage(($this->generalMessageProvider)($evaluation->fsw));
        foreach ($this->contentFactories as $contentFactory) {
            if ($contentFactory->supports($evaluation)) {
                $myEligibilityPage->setProgram($contentFactory->build($evaluation, $user, $crs, $fsw));
            }
        }

        return $myEligibilityPage;
    }
}

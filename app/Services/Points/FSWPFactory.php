<?php

namespace App\Services\Points;

use App\Models\Evaluate\Evaluation;
use App\Models\MyEligibility\FSWContent;
use App\Models\MyEligibility\FSWPPage;
use Illuminate\Support\Arr;

class FSWPFactory
{
    private FSWContentFactory $FSWContentFactory;
    private CRSContentFactory $CRSContentFactory;

    public function __construct(
        FSWContentFactory $FSWContentFactory,
        CRSContentFactory $CRSContentFactory
    ) {
        $this->FSWContentFactory = $FSWContentFactory;
        $this->CRSContentFactory = $CRSContentFactory;
    }

    public function supports(Evaluation $evaluation): bool
    {
        if ($evaluation->fsw < FSWContent::MAX_POINTS_FOR_FSW) {
            return true;
        }

        return !$evaluation->cec_passed & $evaluation->fsw_passed;
    }

    public function build($evaluation, $user, $crs, $fsw): FSWPPage
    {
        return Arr::get($fsw, 'value', 0) >= FSWContent::MAX_POINTS_FOR_FSW
            ? ($this->CRSContentFactory)($user, $evaluation, $crs)
            : ($this->FSWContentFactory)($user, $evaluation, $fsw);
    }
}

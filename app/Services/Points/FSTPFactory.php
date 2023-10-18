<?php

namespace App\Services\Points;

use App\Models\Evaluate\Evaluation;
use App\Models\MyEligibility\FSTPContent;
use App\Models\MyEligibility\FSWContent;
use App\Services\Points\Programs\FSTProgram;
use App\Services\Points\Programs\Helpers\WorkHelper;
use App\Services\StrapiService;
use Illuminate\Support\Arr;

class FSTPFactory
{
    private StrapiService $strapiService;
    private FSTProgram $FSTProgram;

    public function __construct(StrapiService $strapiService, FSTProgram $FSTProgram)
    {
        $this->strapiService = $strapiService;
        $this->FSTProgram = $FSTProgram;
    }

    public function supports(Evaluation $evaluation): bool
    {
        if ($evaluation->fsw < FSWContent::MAX_POINTS_FOR_FSW && $this->isUnderFSTPList($evaluation)) {
            return true;
        }
        return !$evaluation->cec_passed && !$evaluation->fsw_passed && $evaluation->fst_passed;
    }

    public function build(Evaluation $evaluation): FSTPContent
    {
        $FSTPContent = json_decode($this->strapiService->getFSTPData(), true);

        return new FSTPContent(
            Arr::get($FSTPContent, 'Main_text', ''),
            $programDescription = Arr::get($FSTPContent, 'Program_text', ''),
            $programRequirements = $this->FSTProgram->prepareData(Arr::get($FSTPContent, 'fstp_program_items', []), $evaluation),
            $sections = Arr::get($FSTPContent, 'fstp_items', [])
        );
    }

    private function isUnderFSTPList(Evaluation $evaluation): bool
    {
        foreach (Arr::get(json_decode(Arr::get($evaluation, 'payload', ''), true), 'work.history', []) as $work) {
            if (WorkHelper::isUnderFSTPList(Arr::get($work, 'noc', ''))) {
                return true;
            }
        }

        return false;
    }
}

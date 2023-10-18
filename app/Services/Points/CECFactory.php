<?php

namespace App\Services\Points;

use App\Models\Evaluate\Evaluation;
use App\Models\MyEligibility\CECContent;
use App\Models\MyEligibility\FSWContent;
use App\Services\Points\Programs\CECProgram;
use App\Services\StrapiService;
use Illuminate\Support\Arr;

class CECFactory
{
    private StrapiService $strapiService;
    private CECProgram $CECProgram;

    public function __construct(StrapiService $strapiService, CECProgram $CECProgram)
    {
        $this->strapiService = $strapiService;
        $this->CECProgram = $CECProgram;
    }

    public function supports(Evaluation $evaluation): bool
    {
        if ($evaluation->fsw < FSWContent::MAX_POINTS_FOR_FSW) {
            return true;
        }

        return $evaluation->cec_passed;
    }

    public function build(Evaluation $evaluation, $user, $crs, $fsw): CECContent
    {
        $CECContent = json_decode($this->strapiService->getCECData(), true);

        return new CECContent(
            Arr::get($CECContent, 'main_text', ''),
            Arr::get($CECContent, 'benefits', ''),
            $programDescription = Arr::get($CECContent, 'program_text', ''),
            $programRequirements = $this->CECProgram->prepareData(Arr::get($CECContent, 'cec_program_items', []), $evaluation),
            $sections = Arr::get($CECContent, 'cec_items', [])
        );
    }
}

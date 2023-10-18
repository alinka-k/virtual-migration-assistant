<?php

namespace App\Services\Points;

use App\Models\Evaluate\Evaluation;
use App\Models\MyEligibility\CRSContent;
use App\Models\User;
use App\Services\StrapiService;
use Illuminate\Support\Arr;

class CRSContentFactory
{
    private StrapiService $strapiService;
    private CRSSectionsBuilder $sectionsBuilder;
    private ProgramsService $programsService;

    public function __construct(
        StrapiService $strapiService,
        CRSSectionsBuilder $sectionsBuilder,
        ProgramsService $programsService
    ) {
        $this->strapiService = $strapiService;
        $this->sectionsBuilder = $sectionsBuilder;
        $this->programsService = $programsService;
    }

    public function __invoke(User $user, Evaluation $evaluation, array $crs): CRSContent
    {
        $crsData = json_decode($this->strapiService->getCRSData(), true);

        return new CRSContent(
            $currentScore = Arr::get($crs, 'value', 0),
            $scoreBubble = Arr::get($crsData, 'CRS_bubble', ''),
            $sections = $this->sectionsBuilder->prepareData($crs, $user->profile->isUserMarried()),
            $programDescription = Arr::get($crsData, 'fswp_program_items.0.text', ''),
            $programRequirements = $this->programsService->getFSWData(
                $evaluation,
                json_decode(Arr::get($evaluation->points, 'fsw', []), true),
                Arr::get($crsData, 'fswp_program_items')
            ),
            Arr::get($crsData, 'CRS_breakdown', ''),
            Arr::get($crsData, 'Benefits', ''),
        );
    }
}

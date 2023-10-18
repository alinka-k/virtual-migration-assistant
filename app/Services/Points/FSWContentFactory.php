<?php

namespace App\Services\Points;

use App\Models\MyEligibility\FSWContent;
use App\Services\Points\FSWHelpers\SectionsBuilder;
use App\Services\StrapiService;
use Arr;

class FSWContentFactory
{
    private StrapiService $strapiService;
    private SectionsBuilder $sectionsBuilder;
    private ProgramsService $programsService;

    public function __construct(StrapiService $strapiService, SectionsBuilder $sectionsBuilder, ProgramsService $programsService)
    {
        $this->strapiService = $strapiService;
        $this->sectionsBuilder = $sectionsBuilder;
        $this->programsService = $programsService;
    }

    public function __invoke($user, $evaluation, $currentScore): FSWContent
    {
        $data = json_decode($this->strapiService->getFSWPData(), true);

        return new FSWContent(
            Arr::get($data, 'main_text'),
            $this->sectionsBuilder->build($user, Arr::get($data, 'fsw_items')),
            $programDescription = Arr::get($data, 'fswp_program_items.0.text'),
            $programRequirements = $this->programsService->getFSWData(
                $evaluation,
                json_decode(Arr::get($evaluation->points, 'fsw', []), true),
                Arr::get($data, 'fswp_program_items')
            ),
            Arr::get($currentScore, 'value', 0),
        );
    }
}

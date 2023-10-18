<?php

namespace App\Services\Points;

use App\Models\Evaluate\Evaluation;
use App\Services\Points\Programs\CECProgram;
use App\Services\Points\Programs\FSTProgram;
use App\Services\Points\Programs\FSWProgram;
use App\Services\StrapiService;
use Arr;

class ProgramsService
{
    private FSWProgram $FSWProgram;
    private StrapiService $strapiService;
    private CECProgram $CECProgram;
    private FSTProgram $FSTProgram;

    public function __construct(FSWProgram $FSWProgram, StrapiService $strapiService, CECProgram $CECProgram, FSTProgram $FSTProgram)
    {
        $this->FSWProgram = $FSWProgram;
        $this->strapiService = $strapiService;
        $this->CECProgram = $CECProgram;
        $this->FSTProgram = $FSTProgram;
    }

    public function getFSWData(Evaluation $evaluation, array $FSWLog, array $FSWProgramData): array
    {
        return $this->FSWProgram->prepareData($FSWProgramData, $evaluation, $FSWLog);
    }

    public function getFSTPData(Evaluation $evaluation): array
    {
        $data = json_decode($this->strapiService->getFSTPData(), true);

        return $this->FSTProgram->prepareData(Arr::get($data, 'fstp_program_items', []), $evaluation, $data);
    }

    public function getCECData(Evaluation $evaluation): array
    {
        $data = json_decode($this->strapiService->getCECData(), true);
        return $this->CECProgram->prepareData(Arr::get($data, 'cec_program_items', []), $evaluation, $data);
    }
}

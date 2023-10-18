<?php

namespace App\Services;

use App\Enums\EvaluationStatus;
use App\Http\Resources\Evaluate\EvaluateProfile as EvaluateResource;
use App\Jobs\Evaluation\Evaluate as EvaluateJob;
use App\Models\Evaluate\Evaluation as EvaluationModel;
use App\Models\Evaluate\EvaluationPoint;
use App\Models\User;
use App\Models\VirtualProfile;
use App\Repositories\Contract\UserRepositoryContract;
use App\Repositories\Contract\VirtualProfileRepositoryContract;
use Arr;
use Illuminate\Support\Facades\Log;

class Evaluation
{
    /** @var UserRepositoryContract */
    private UserRepositoryContract $users;

    /** @var VirtualProfileRepositoryContract */
    private VirtualProfileRepositoryContract $virtualProfile;

    private MigrationService $service;

    public function __construct(
        UserRepositoryContract $users,
        VirtualProfileRepositoryContract $virtualProfile,
        MigrationService $migrationService
    ) {
        $this->users = $users;
        $this->virtualProfile = $virtualProfile;
        $this->service = $migrationService;
    }

    public function create(string $userId)
    {
        try {
            /** @var User */
            $user = $this->users->find($userId);
            $evaluation = new EvaluationModel([
                'status' => EvaluationStatus::draft(),
                'payload' => (new EvaluateResource($user))->toJson(),
            ]);
            $user->evaluations()->save($evaluation);
            return $this->submitProfile($evaluation);
        } catch (\Exception $exception) {
            Log::error('evaluate error', ['exception' => $exception, 'evaluationData' => empty($evaluation) ? null : $evaluation]);
            return null;
        }
    }

    public function evaluateVirtual(string $virtual_profile_id)
    {
        try {
            /** @var VirtualProfile $profile */
            $profile = $this->virtualProfile->find($virtual_profile_id);

            if (!$profile) {
                return false;
            }

            $user = $profile->user;

            $evaluation = new EvaluationModel([
                'status' => EvaluationStatus::draft(),
                'payload' => (new MergeService($profile))->generate(),
            ]);

            $evaluation->virtual_profile_id = $virtual_profile_id;

            $user->evaluations()->save($evaluation);

            return $this->submitVirtualProfile($evaluation);
        } catch (\Exception $exception) {
            Log::critical($exception);
            return null;
        }
    }

    protected function submitVirtualProfile(EvaluationModel $evaluation): ?EvaluationModel
    {
        $response = $this->service->evaluate(json_decode($evaluation->payload, true));

        if (!$response->successful()) {
            $evaluation->status = EvaluationStatus::error();
            $evaluation->response = $response->body();
            $evaluation->save();
            Log::warning($response->body());
            return null;
        }

        $result = json_decode($response->body(), true);

        if ($result === null) {
            Log::error('Evaluation response not json ', ['response_body' =>  $response->body()]);
            return null;
        }

        $evaluation->crs = Arr::get($result, 'evaluations.fsw_crs_score.value');
        $evaluation->fsw = Arr::get($result, 'evaluations.fsw_score.value');
        $evaluation->fsw_log = Arr::get($result, 'evaluations.fsw_score.log');
        $evaluation->fsw_crs_log = Arr::get($result, 'evaluations.fsw_crs_score.log');
        $evaluation->status = EvaluationStatus::published();
        $evaluation->eligibility = json_encode(Arr::pluck(Arr::get($result, 'eligible_programs'), 'stream.type', 'id'));
        $evaluation->fsw_passed = Arr::get($result, 'evaluations.fsw_evaluator.value');
        $evaluation->cec_passed = Arr::get($result, 'evaluations.cec_evaluator.value');
        $evaluation->fst_passed = Arr::get($result, 'evaluations.fst_evaluator.value');

        $responsePoints = $this->service->parsePoints(json_decode($evaluation->payload, true));

        if ($responsePoints->successful()) {
            $resultPoints = json_decode($responsePoints->body(), true);
            $pointModel = new EvaluationPoint();
            $pointModel->view = json_encode(Arr::get($resultPoints, 'fsw_crs_score.view'));
            $pointModel->crs = json_encode(Arr::get($resultPoints, 'fsw_crs_score', []));
            $pointModel->fsw = json_encode(Arr::get($resultPoints, 'fsw_score', []));

            $evaluation->points()->save($pointModel);
        }

        $evaluation->save();
        return $evaluation;
    }

    protected function submitProfile(EvaluationModel $evaluation): ?EvaluationModel
    {
        $response = $this->service->evaluate(json_decode($evaluation->payload, true));

        if (!$response->successful()) {
            $evaluation->status = EvaluationStatus::error();
            $evaluation->response = $response->body();
            $evaluation->save();
            Log::warning($response->body());
            return null;
        }

        $result = json_decode($response->body(), true);

        if ($result === null) {
            Log::error('Evaluation response not json ', ['response_body' =>  $response->body()]);
            return null;
        }

        $evaluation->crs = Arr::get($result, 'evaluations.fsw_crs_score.value');
        $evaluation->fsw = Arr::get($result, 'evaluations.fsw_score.value');
        $evaluation->fsw_log = Arr::get($result, 'evaluations.fsw_score.log');
        $evaluation->fsw_crs_log = Arr::get($result, 'evaluations.fsw_crs_score.log');
        $evaluation->status = EvaluationStatus::published();
        $evaluation->eligibility = json_encode(Arr::pluck(Arr::get($result, 'eligible_programs'), 'stream.type', 'id'));
        $evaluation->fsw_passed = Arr::get($result, 'evaluations.fsw_evaluator.value');
        $evaluation->cec_passed = Arr::get($result, 'evaluations.cec_evaluator.value');
        $evaluation->fst_passed = Arr::get($result, 'evaluations.fst_evaluator.value');

        $responsePoints = $this->service->parsePoints(json_decode($evaluation->payload, true));

        if ($responsePoints->successful()) {
            $resultPoints = json_decode($responsePoints->body(), true);
            $pointModel = new EvaluationPoint();
            $pointModel->view = json_encode(Arr::get($resultPoints, 'fsw_crs_score.view'));
            $pointModel->crs = json_encode(Arr::get($resultPoints, 'fsw_crs_score', []));
            $pointModel->fsw = json_encode(Arr::get($resultPoints, 'fsw_score', []));

            $evaluation->points()->save($pointModel);
        }

        $evaluation->save();
        return $evaluation;
    }

    public function evaluateNotSubmitted(): void
    {
        foreach ($this->users->findNotEvaluated() as $user) {
            EvaluateJob::dispatch($user->id);
        }
    }
}

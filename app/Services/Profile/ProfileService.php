<?php

namespace App\Services\Profile;

use App\Exceptions\ParseProfileException;
use App\Models\User;
use App\Repositories\Contract\UserRepositoryContract;
use App\Services\MigrationService;
use App\Services\Profile\ImportHelpers\CanadianJobOffer;
use App\Services\Profile\ImportHelpers\CanadianRelatives;
use App\Services\Profile\ImportHelpers\Comments;
use App\Services\Profile\ImportHelpers\Education;
use App\Services\Profile\ImportHelpers\FuturePlans;
use App\Services\Profile\ImportHelpers\Language;
use App\Services\Profile\ImportHelpers\Manitoba;
use App\Services\Profile\ImportHelpers\NetWorth;
use App\Services\Profile\ImportHelpers\ParseProfileInterface;
use App\Services\Profile\ImportHelpers\Profile;
use App\Services\Profile\ImportHelpers\Spouse;
use App\Services\Profile\ImportHelpers\Work;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class ProfileService
{
    /** @var UserRepositoryContract */
    private UserRepositoryContract $users;

    private MigrationService $service;

    private array $mappedFieldsToClasses = [
        Profile::class,
        Language::class,
        Education::class,
        Comments::class,
        Work::class,
        CanadianRelatives::class,
        Manitoba::class,
        CanadianJobOffer::class,
        Spouse::class,
        NetWorth::class,
        FuturePlans::class,
    ];

    public function __construct(
        UserRepositoryContract $users,
        MigrationService $migrationService
    ) {
        $this->users = $users;
        $this->service = $migrationService;
    }

    /**
     * @throws ParseProfileException
     */
    public function parseExistingProfile(string $user_id): bool
    {
        /** @var User $user */
        $user = $this->users->find($user_id);
        $response = $this->service->findAssessment($user->email);
        if (!$response->successful()) {
            throw new ParseProfileException('Something went wrong.');
        }

        $assessmentId = Arr::get(json_decode($response->body(), true), 'assessments.0.id');
        if (!$assessmentId) {
            throw new ParseProfileException('Your Migration profile is missing, check your email and try it later.');
        }

        $responseAssessment = $this->service->getAssessmentById($assessmentId);
        if (!$responseAssessment->successful()) {
            throw new ParseProfileException('Your Migration profile is missing.');
        }
        $assessment = Arr::get(json_decode($responseAssessment->body(), true), 'assessment', []);
        $profileData = Arr::get($assessment, 'data');
        if (empty($profileData)) {
            throw new ParseProfileException('The data from Migration was empty.');
        }

        return $this->saveProfile($user, $profileData);
    }

    protected function saveProfile($user, $data): bool
    {
        try {
            DB::transaction(function () use ($user, $data) {
                foreach ($this->mappedFieldsToClasses as $class) {
                    /** @var ParseProfileInterface $model */
                    $class::loadAndSaveProfileInfo($user, $data);
                }
            });
            return true;
        } catch (Exception $e) {
            \Log::debug($e);
        }
        return false;
    }
}

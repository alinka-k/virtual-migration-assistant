<?php

namespace App\Repositories;

use App\Jobs\Evaluation\EvaluateVirtual as EvaluateVirtualJob;
use App\Models\VirtualProfile;
use App\Models\VirtualProfile\VirtualAbroadStudyItem;
use App\Models\VirtualProfile\VirtualCanadianStudyItem;
use App\Models\VirtualProfile\VirtualCanadianWorkItem;
use App\Models\VirtualProfile\VirtualDemandedOccupation;
use App\Models\VirtualProfile\VirtualEntrepreneurship;
use App\Models\VirtualProfile\VirtualJobOffer;
use App\Models\VirtualProfile\VirtualLanguage;
use App\Models\VirtualProfile\VirtualRelative;
use App\Models\VirtualProfile\VirtualSaveInterface;
use App\Models\VirtualProfile\VirtualSpouse;
use App\Models\VirtualProfile\VirtualWorkExperience;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VirtualProfileRepository extends BaseRepository
{
    protected $model = VirtualProfile::class;

    private string $name = 'Pathway';
    private int $user_id;
    private ?int $virtual_profile_id = null;
    private array $data;
    private array $mappedFieldsToClasses = [
        'entrepreneurship' => VirtualEntrepreneurship::class,
        'language' => VirtualLanguage::class,
        'spouse' => VirtualSpouse::class,
        'work' => VirtualWorkExperience::class,
        'canadianJobOffer' => VirtualJobOffer::class,
        'relatives' => VirtualRelative::class,
        'occupationsDemand' => VirtualDemandedOccupation::class,
        'canadianWorkExperience' => VirtualCanadianWorkItem::class,
        'canadianStudyExperience' => VirtualCanadianStudyItem::class,
        'abroadStudyExperience' => VirtualAbroadStudyItem::class,
    ];

    public function loadData(Request $request)
    {
        $this->user_id = $request->user()->id;
        $this->data = $request->all();
        if ($request->id) {
            $this->virtual_profile_id = $request->id;
        }
        if ($request->name) {
            $this->name = $request->name;
        }
    }

    public function save($markProfileAsSaved = true): bool
    {
        return $this->virtual_profile_id ?
            $this->updateLoadedModel() :
            $this->saveLoadedModel($markProfileAsSaved);
    }

    public function saveLoadedModel($markProfileAsSaved = true): bool
    {
        try {
            $virtualProfile = new VirtualProfile([
                'name' => $this->name,
                'saved' => $markProfileAsSaved ? VirtualProfile::SAVED : VirtualProfile::NOT_SAVED
            ]);

            DB::transaction(function () use ($virtualProfile) {
                $virtualProfile->user_id = $this->user_id;
                $virtualProfile->save();

                foreach ($this->mappedFieldsToClasses as $key => $class) {
                    if (!isset($this->data[$key])) {
                        continue;
                    }
                    /** @var  VirtualSaveInterface $model */
                    $class::loadAndSave($virtualProfile->id, $this->data[$key]);
                }
            });

            return $this->evaluate($virtualProfile->id);
        } catch (Exception $e) {
            Log::critical($e);
        }
        return false;
    }

    protected function updateLoadedModel(): bool
    {
        $model = VirtualProfile::firstWhere([
            'saved' => VirtualProfile::SAVED,
            'id' => $this->virtual_profile_id,
            'user_id' => $this->user_id,
        ]);

        if (!$model) {
            $this->illegalEntry();
            return false;
        }

        try {
            if ($model->name !== $this->name && $this->name !== 'Pathway') {
                $model->update(['name' => $this->name]);
            }

            DB::transaction(function () use ($model) {
                foreach ($this->mappedFieldsToClasses as $key => $class) {
                    if (!isset($this->data[$key])) {
                        continue;
                    }
                    /** @var  VirtualSaveInterface $model */
                    $class::loadAndSave($model->id, $this->data[$key]);
                }
            });

            return $this->evaluate($model->id);
        } catch (Exception $e) {
            Log::critical($e);
        }
        return false;
    }

    protected function illegalEntry()
    {
        $message = 'User with ID[%d] tried to change VirtualProfile with ID[%d]';
        Log::critical(sprintf($message, $this->user_id, $this->virtual_profile_id));
    }

    protected function evaluate($virtualProfileId): bool
    {
        try {
            EvaluateVirtualJob::dispatch($virtualProfileId);
        } catch (Exception $e) {
            Log::critical($e);
            return false;
        }
        return true;
    }
}

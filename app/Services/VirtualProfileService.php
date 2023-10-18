<?php

namespace App\Services;

use App\Repositories\VirtualProfileRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VirtualProfileService
{
    private VirtualProfileRepository $virtualProfileRepository;

    public function __construct(VirtualProfileRepository $virtualProfileRepository)
    {
        $this->virtualProfileRepository = $virtualProfileRepository;
    }

    public function save(Request $request): bool
    {
        $this->virtualProfileRepository->loadData($request);

        return $this->virtualProfileRepository->save();
    }

    public function evaluate(Request $request): bool
    {
        try {
            $this->virtualProfileRepository->loadData($request);

            return $this->virtualProfileRepository->save(false);
        } catch (Exception $exception) {
            Log::critical($exception);
            return false;
        }
    }
}

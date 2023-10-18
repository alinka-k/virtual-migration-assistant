<?php

namespace App\Services\Points;

use App\Models\MyEligibility\FSWContent;
use App\Models\MyEligibility\GeneralMessage;
use App\Services\StrapiService;

class GeneralMessageProvider
{
    private StrapiService $strapiService;

    public function __construct(StrapiService $strapiService)
    {
        $this->strapiService = $strapiService;
    }

    public function __invoke($userScore): GeneralMessage
    {
        $generalMessage = $this->strapiService->getGeneralMessage();

        if ($userScore < FSWContent::MAX_POINTS_FOR_FSW) {
            return new GeneralMessage(
                collect(json_decode($generalMessage))->where('is_user_eligible', false)->first()->general_message
            );
        }
        return new GeneralMessage(
            collect(json_decode($generalMessage))->where('is_user_eligible', true)->first()->general_message,
            collect(json_decode($generalMessage))->where('is_user_eligible', true)->first()->general_message_bubble
        );
    }
}

<?php

namespace App\Listeners\Notification;

use App\Events\EligibilityPrograms\SendEligibility;
use App\Mail\EligibilityProgram;

class SendEmailWithEligibilityNotificationLogger extends UserNotificationLogger
{
    public function handle(SendEligibility $event)
    {
        $user = $event->evaluation->user;
        $html = (new EligibilityProgram($event->evaluation))->render();
        $subtitle = 'You passed a few eligibility programs!';
        $this->userNotificationRepository->createUserNotification(
            $user->id,
            'Eligibility',
            $html,
            $subtitle
        );
    }
}

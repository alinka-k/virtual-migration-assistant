<?php

namespace App\Listeners\EligibilityPrograms;

use App\Events\EligibilityPrograms\SendEligibility;
use App\Notifications\Eligibility as EligibilityNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailWithEligibility implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param SendEligibility $event
     * @return void
     */
    public function handle(SendEligibility $event)
    {
        $contactTool = $event->evaluation->user->userContactTool;

        if (empty($contactTool) || $contactTool->email) {
            $notificationType = $event->evaluation->user->notificationType;
            if (empty($notificationType) || $notificationType->all_programs) {
                $event->evaluation->notify(new EligibilityNotification($event->evaluation));
            }
        }
    }
}

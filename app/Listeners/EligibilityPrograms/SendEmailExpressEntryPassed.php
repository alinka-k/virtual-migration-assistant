<?php

namespace App\Listeners\EligibilityPrograms;

use App\Events\EligibilityPrograms\ExpressEntryPassed;
use App\Notifications\ExpressEntryPassed as ExpressEntryPassedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailExpressEntryPassed implements ShouldQueue
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
     * @param ExpressEntryPassed $event
     * @return void
     */
    public function handle(ExpressEntryPassed $event)
    {
        $contactTool = $event->user->userContactTool;
        if (empty($contactTool) || $contactTool->email) {
            $notificationType = $event->user->notificationType;
            if (empty($notificationType) || $notificationType->express_entry) {
                $event->user->notify(new ExpressEntryPassedNotification($event->user));
            }
        }
    }
}

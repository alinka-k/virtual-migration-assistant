<?php

namespace App\Listeners\Notification;

use App\Events\EligibilityPrograms\ExpressEntryPassed;
use App\Notifications\ExpressEntryPassed as ExpressEntryPassedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailExpressEntryPassedNotificationLogger extends UserNotificationLogger implements ShouldQueue
{
    /**
     * @param ExpressEntryPassed $event
     */
    public function handle(ExpressEntryPassed $event)
    {
        $notification = new ExpressEntryPassedNotification($event->user);
        $mail = $notification->toMail($event->user);
        $html = $mail->render();
        $subtitle = 'You passed FSWP (Federal Skilled Worker Program) / Express Entry! Congratulations!';
        $this->userNotificationRepository->createUserNotification($event->user->id, 'Entry Passed', $html, $subtitle);
    }
}

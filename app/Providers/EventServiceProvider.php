<?php

namespace App\Providers;

use App\Events\EligibilityPrograms\ExpressEntryPassed;
use App\Events\EligibilityPrograms\SendEligibility;
use App\Listeners\EligibilityPrograms\SendEmailExpressEntryPassed;
use App\Listeners\EligibilityPrograms\SendEmailWithEligibility;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Listeners\Notification\SendEmailExpressEntryPassedNotificationLogger;
use App\Listeners\Notification\SendEmailWithEligibilityNotificationLogger;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        ExpressEntryPassed::class => [
            SendEmailExpressEntryPassed::class,
            SendEmailExpressEntryPassedNotificationLogger::class
        ],
        SendEligibility::class => [
            SendEmailWithEligibility::class,
            SendEmailWithEligibilityNotificationLogger::class
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}

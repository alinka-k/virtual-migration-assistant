<?php

namespace App\Listeners\Notification;

use App\Repositories\Notification\UserNotificationRepository;

class UserNotificationLogger
{
    protected UserNotificationRepository $userNotificationRepository;

    public function __construct(UserNotificationRepository $userNotificationRepository)
    {
        $this->userNotificationRepository = $userNotificationRepository;
    }
}

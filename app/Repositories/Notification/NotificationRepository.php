<?php

namespace App\Repositories\Notification;

use App\Models\Notification\UserContactTool;
use App\Models\Notification\UserNotificationType;

class NotificationRepository
{
    private UserNotificationType $userNotificationType;
    private UserContactTool $userContactTool;

    public function __construct(UserNotificationType $userNotificationType, UserContactTool $userContactTool)
    {
        $this->userNotificationType = $userNotificationType;
        $this->userContactTool = $userContactTool;
    }

    public function getNotificationSetting($userId)
    {
        return $this->userNotificationType->where('user_id', $userId)->first();
    }

    public function getNotifyViaEmailSetting($userId)
    {
        return $this->userContactTool->where('user_id', $userId)->first();
    }
}

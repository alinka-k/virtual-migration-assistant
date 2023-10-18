<?php

namespace App\Repositories\Notification;

use App\Enums\UserNotificationStatus;
use App\Models\User;
use App\Models\User\UserNotification;

class UserNotificationRepository
{
    private UserNotification $userNotification;

    public function __construct(UserNotification $userNotification)
    {
        $this->userNotification = $userNotification;
    }

    public function userNotification(User $user, $params)
    {
        $query = UserNotification::where('user_id', $user->id);
        $query->orderBy('id', 'desc');
        if (isset($params->status) && $params->status !== 'all') {
            $query->where('status', (int)$params->status);
        }

        if (!empty($params->offset)) {
            $query->offset($params->offset);
        }

        if (!empty($params->limit)) {
            $query->limit($params->limit);
        }
        return $query->get();
    }

    public function userNotificationWithStatus(User $user, int $notificationStatus)
    {
        return UserNotification::where('user_id', $user->id)->where('status', $notificationStatus)->get();
    }

    public function hasUserNotificationByTitle(User $user, string $title): bool
    {
        return (bool)UserNotification::where('user_id', $user->id)->where('title', $title)->count();
    }

    public function countNewUserNotifications(User $user)
    {
        return UserNotification::where('user_id', $user->id)->where('status', UserNotificationStatus::getValue('New'))->count();
    }

    public function createUserNotification(int $user_id, string $title, string $body, ?string $subtitle = null)
    {
        $userNotification = new UserNotification([
            'title' => $title,
            'subtitle' => $subtitle,
            'body' => $body,
            'status' => UserNotificationStatus::New,
        ]);

        $userNotification->user_id = $user_id;

        return $userNotification->save();
    }

    public function updateUserNotificationStatus(int $userNotificationId, int $status)
    {
        $userNotification = UserNotification::where('id', $userNotificationId)->first();
        $userNotification->status = $status;
        $userNotification->save();
        return $userNotification;
    }

    public function destroyNotification(User $user, int $notificationId)
    {
        return UserNotification::where('id', $notificationId)->where('user_id', $user->id)->delete();
    }
}

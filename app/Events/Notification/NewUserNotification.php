<?php

namespace App\Events\Notification;

use App\Enums\UserNotificationStatus;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewUserNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $notification;

    public $user_id;

    public function __construct($notification)
    {
        $this->notification = $notification->where('user_id', $notification->user_id)->where('status', UserNotificationStatus::New)->count();
        $this->user_id = $notification->user_id;
    }

    public function broadcastOn()
    {
        return ['notification.' . $this->user_id];
    }

    public function broadcastAs()
    {
        return 'notification';
    }
}

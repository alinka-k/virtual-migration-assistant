<?php

namespace App\Http\Resources\User;

use App\Enums\UserNotificationStatus;
use App\Services\DateService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserNotificationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle ?: 'You have a new message from MigrationAssistant',
            'body' => $this->body,
            'status' => Arr::get(UserNotificationStatus::asSelectArray(), $this->status),
            'statusNumber' => $this->status,
            'interval' => (new DateService())->getNotificationTime($this->created_at)
        ];
    }
}

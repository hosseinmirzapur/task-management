<?php

namespace App\Http\Services;

use App\Exceptions\CustomException;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;
use App\Models\User;

class NotificationService
{
    /**
     * @param string $title
     * @param string $desc
     * @param int $userId
     * @return NotificationResource
     * @throws CustomException
     */
    public function send(string $title, string $desc, int $userId): NotificationResource
    {
        $user = User::query()->find($userId);
        if (!$user) {
            throw new CustomException('user not found', 404);
        }

        return NotificationResource::make($user->notifications()->create([
            'title' => $title,
            'description' => $desc,
            'user_id' => $userId,
        ]));
    }

    /**
     * @param $notifId
     * @return void
     * @throws CustomException
     */
    public function markAsSeen($notifId): void
    {
        $notification = Notification::query()->find($notifId);
        if (!$notification) {
            throw new CustomException('notification not found', 404);
        }
        $notification->markAsSeen();
    }
}

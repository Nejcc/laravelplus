<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class NotificationPolicy
{
    public function markAsRead(User $user, DatabaseNotification $notification)
    {
        return $user->id === $notification->notifiable_id;
    }

    public function delete(User $user, DatabaseNotification $notification)
    {
        return $user->id === $notification->notifiable_id;
    }
} 
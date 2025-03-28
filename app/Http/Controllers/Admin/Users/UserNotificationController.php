<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

final class UserNotificationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Mark a notification as read.
     *
     * @param User $user
     * @param DatabaseNotification $notification
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRead(User $user, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        return back()->with('success', __('Notification marked as read.'));
    }

    /**
     * Mark all notifications as read.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAllAsRead(User $user)
    {
        $user->unreadNotifications->markAsRead();

        return back()->with('success', __('All notifications marked as read.'));
    }
} 
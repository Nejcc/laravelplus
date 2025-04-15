<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

final class NotificationController extends Controller
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead(DatabaseNotification $notification): RedirectResponse
    {
        $this->authorize('markAsRead', $notification);
        
        $notification->markAsRead();
        
        return back()->with('success', __('Notification marked as read'));
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): RedirectResponse
    {
        auth()->user()->unreadNotifications->markAsRead();
        
        return back()->with('success', __('All notifications marked as read'));
    }

    public function destroy(DatabaseNotification $notification)
    {
        $this->authorize('delete', $notification);
        
        $notification->delete();
        
        return back()->with('success', __('Notification deleted'));
    }
}

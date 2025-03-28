<?php

declare(strict_types=1);

namespace App\Http\Controllers\Ajax\User\Notification;

use App\Http\Controllers\Controller;
use App\Notifications\WhatsNewNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class ReadWhatsNewController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $request->validate(['user_news' => 'int']);

        $user = auth()->user();
        $user->is_read_news = true;
        $user->save();

        // Create a notification for the What's New feature
        $user->notify(new WhatsNewNotification());

        return redirect()->route('home');
    }
}

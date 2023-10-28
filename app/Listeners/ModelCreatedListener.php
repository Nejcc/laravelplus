<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ModelCreated;
use App\Notifications\Users\NewUserNotification;
use App\Models\User;

final class ModelCreatedListener
{
    /**
     * Handle the event.
     */
    public function handle(ModelCreated $event): void
    {
        
        $user = User::findOrFail($event->getModel()->user_id);
        
        $user->notify(
            new NewUserNotification($user)
        );
    }
}

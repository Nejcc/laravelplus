<?php

declare(strict_types=1);

namespace App\Notifications\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

// TODO: wip
final class NewUserNotification extends Notification
{
    use Queueable;

    protected array $model;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(array $model)
    {
        $this->model = $model;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage())
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title'   => 'New Model Created',
            'message' => 'A new model has been created',
            'url'     => url('/models/'.$this->model->id),
        ];
    }

//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//            ->subject('New Model Created')
//            ->line('Hello, ' . $notifiable->name . '!')
//            ->line('A new model has been created with the following details:')
//            ->action('View Model', url('/models/' . $this->model->id));
//    }
}

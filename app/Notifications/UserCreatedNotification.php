<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Mail\UserCreatedNotificationMail;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserCreatedNotification extends Notification
{
    use Queueable;

    public $url = 'http://127.0.0.1:8000';
    public $mdp;
    public $user;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $mdp)
    {
        $this->user = $user;
        $this->mdp = $mdp;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new UserCreatedNotificationMail($notifiable, $this->mdp))
                ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

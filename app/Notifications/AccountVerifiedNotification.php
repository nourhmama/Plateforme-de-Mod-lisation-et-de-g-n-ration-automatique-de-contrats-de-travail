<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;



class AccountVerifiedNotification extends Notification
{

    use Queueable;
    protected $url;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public function __construct(string $url)
    {
        $this->url = $url;
    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Votre compte a été vérifié avec succès.')
            ->line('Vous pouvez maintenant vous connecter à votre compte.')
            ->action('Se connecter', $this->url);
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

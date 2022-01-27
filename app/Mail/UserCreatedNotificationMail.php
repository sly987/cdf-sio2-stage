<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCreatedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $mdp;
    public $url = 'http://127.0.0.1:8000';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $mdp)
    {
        $this->user = $user;
        $this->mdp = $mdp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre compte vient d\'être crée')
                    ->markdown('emails.mail-createuser');
    }
}

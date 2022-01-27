<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FileDeletedNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $url = 'http://127.0.0.1:8000';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Votre fiche n\était pas valide')
                    ->markdown('emails.mail-deletebp');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailCreateUser extends Mailable
{
    use Queueable, SerializesModels;

    public $url = 'http://localhost';
    public $data = [];
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Array $datamail)
    {
        $this->data = $datamail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Compte crée par Madame Tessier')
                    ->markdown('emails.mail-createuser');
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class test extends Mailable
{
    use Queueable, SerializesModels;

    public $data = '';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(String $mail)
    {
        $this->data = $mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@tessier.fr')
                    ->subject('Votre compte a été crée !')
                    ->view('emails.test');
        
    }
}

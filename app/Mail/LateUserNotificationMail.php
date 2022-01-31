<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class LateUserNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $mois;
    public $url = 'http://127.0.0.1:8000';
    public $annee;
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $annee, $mois)
    {
        $this->user = $user;
        $this->mois = $mois;
        $this->annee = $annee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Etat de votre fiche de paie')
                    ->markdown('emails.mail-lateuser');
    }
}

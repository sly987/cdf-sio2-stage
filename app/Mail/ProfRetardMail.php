<?php

namespace App\Mail;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProfRetardMail extends Mailable
{
    public $users;
    public $mois;
    public $annee;
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($users, $annee, $mois)
    {
        $this->users= $users;
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
        return $this->subject('[URGENT]Liste des retardataires')
                    ->view('emails.mail-latecomers');
    }
}

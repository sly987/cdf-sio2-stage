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
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users=User::all();
        if(Carbon::now()->month==1)
        {
            $this->mois=12;
            $this->annee=Carbon::now()->year-1;
        }
        else
        {
            $this->mois=Carbon::now()->month-1;
            $this->annee=Carbon::now()->year;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('liste des retardataires')
                    ->markdown('emails.Retardataire');
    }
}

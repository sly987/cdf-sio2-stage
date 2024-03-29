<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Mois;
use App\Models\User;
use App\Models\Annee;
use App\Models\Fiche;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\LateUserNotificationMail;
use App\Notifications\LateUserNotification;

class SendLateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:SendLateUser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Tout mettre dans une fonction a appeler
        
        $this->mois=$mois=Mois::moisPrecedent();
        $this->annee=$annee=Annee::anneePrecedent();

        $users=User::where('admin','=',0)->get();
        foreach($users as $user)
        {
            $fiches = $user->fiches;
            foreach($fiches as $fiche)
            {
                if($fiche->actif == 1 AND $fiche->envoye == 0 AND $fiche->mois->mois == $mois AND $fiche->mois->annee->annee == $annee)
                    Mail::to($user->email)->send(new LateUserNotificationMail($user,$annee,$mois));
            }
        }
    }
}

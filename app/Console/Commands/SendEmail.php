<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Mois;
use App\Models\User;
use App\Models\Annee;
use App\Mail\ProfRetardMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sendMail';

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
        $this->mois=$mois=Mois::moisPrecedent();
        $this->annee=$annee=Annee::anneePrecedent();
        $this->users=$users=User::all();
        $this->admin=User::select('email')->where('admin', '=', 1)->get();
        Mail::to($this->admin)->send(new ProfRetardMail($users,$annee,$mois));;
    }
}

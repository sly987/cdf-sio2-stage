<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\ProfRetardMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        if(Carbon::now()->month==1)
        {
            $this->mois=$mois=12;
            $this->annee=$annee=Carbon::now()->year-1;
        }
        else
        {
            $this->mois=$mois=Carbon::now()->month-1;
            $this->annee=$annee=Carbon::now()->year;
        }
        $this->users=$users=User::all();
        $this->admin=DB::table('users')->select('email')->where('admin', '=', 1)->get();
        Mail::to($this->admin)->send(new ProfRetardMail($users,$mois,$annee));;
    }
}

<?php

namespace Database\Seeders;

use App\Models\Mois;
use App\Models\User;

use App\Models\Annee;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    
    public function run()
    {
        User::create([
            'nom'=>'admin',
            'prenom'=>'admin',
            'email'=>'admin@mail.fr',
            'admin'=>1,
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(10)->create();
        \App\Models\Annee::factory(10)->create();
        for($i=2010; $i<2020; $i++)
        {
            for($j=1; $j<=12;$j++)
            {
                Mois::create([
                    'mois_id'=>$j,
                    'annee_id'=>$i
                ]);
            }
        }
        

        
        
    }
}

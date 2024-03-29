<?php

namespace Database\Seeders;

use App\Models\Mois;
use App\Models\User;
use App\Models\Annee;
use App\Models\Fiche;
use App\Models\Statut;
use App\Models\UserStatut;
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
        Statut::create([
            'libelle'=>'PRIMAIRE'
        ]);

        Statut::create([
            'libelle'=>'COLLEGE'
        ]);

        Statut::create([
            'libelle'=>'LYCEE'
        ]);

        Statut::create([
            'libelle'=>'CAMPUS'
        ]);

        Statut::create([
            'libelle'=>'REMPLACANT'
        ]);

        User::create([
            'nom'=>'sadmin',
            'prenom'=>'sadmin',
            'email'=>'sadmin@mail.fr',
            'admin'=>1,
            'superAdmin'=>1,
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'nom'=>'admin',
            'prenom'=>'admin',
            'email'=>'admin@mail.fr',
            'admin'=>1,
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'nom'=>'user',
            'prenom'=>'user',
            'email'=>'user@mail.fr',
            'admin'=>0,
            'email_verified_at' => now(),
            'password' => Hash::make('12345678'), // password
            'remember_token' => Str::random(10),
        ]);
        \App\Models\User::factory(2)->create();

        $t_mois = array(
            "janvier",
            "fevrier",
            "mars",
            "avril",
            "mai",
            "juin",
            "juillet",
            "aout",
            "septembre",
            "octobre",
            "novembre",
            "decembre",
        );

        for($i=2020; $i<=2022; $i++)
        {
            Annee::create([
                'annee'=>$i
            ]);


            for($j=1; $j<=12;$j++)
            {

                Mois::create([
                    'mois'=>$j,
                    'annee_id'=>$i-2019,
                    'libelle'=>$t_mois[$j-1]
                ]);

                for($k=1;$k<=5;$k++)
                {
                    Fiche::create([
                        'user_id'=>$k,
                        'mois_id'=>$j+12*($i-2020),
                        'chemin_fiche' => NULL,
                        'envoye' => 0,
                    ]);
                }   
            }
        }

        UserStatut::create([
            'user_id' => 4,
            'statut_id' => 1
        ]);

        UserStatut::create([
            'user_id' => 3,
            'statut_id' => 3
        ]);

        UserStatut::create([
            'user_id' => 5,
            'statut_id' => 2
        ]);

        UserStatut::create([
            'user_id' => 3,
            'statut_id' => 2
        ]);
    }
}

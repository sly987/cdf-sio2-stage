<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Annee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mois extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    public function annee()
    {
        return $this->belongsTo(Annee::class);
    }

    public function fiches()
    {
        return $this->hasMany(Fiche::class);
    }

    public static function moisPrecedent()
    {
        if(Carbon::now()->month==1)
        {
            $mois=12;

        }
        else
        {
            $mois=Carbon::now()->month-1;

        }
        return $mois;
    }

    public static function zerotation($prof)
    {
        if($prof->mois->mois <= 9)
            $zero = '_0';
        else
            $zero = '_';

        return $zero;
    }
}

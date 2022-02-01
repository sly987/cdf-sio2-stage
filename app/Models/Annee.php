<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Mois;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Annee extends Model
{
    use HasFactory;
    public $timestamps = FALSE;

    public function mois()
    {
        return $this-> hasMany(Mois::class);
    }

    public static function anneePrecedent()
    {
        if(Carbon::now()->month==1)
        {
            
            $annee=Carbon::now()->year-1;
        }
        else
        {
            $annee=Carbon::now()->year;
        }
        return $annee;
    }
}

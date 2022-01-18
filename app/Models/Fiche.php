<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fiche extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mois()
    {
        return $this->belongsTo(Mois::class);
    }

    public function fiche()
    {
        return $this->belongsTo(Annee::class);
    }
}


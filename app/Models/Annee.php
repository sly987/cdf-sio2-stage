<?php

namespace App\Models;

use App\Models\Mois;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Annee extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    public function comments()
    {
        return $this-> hasMany(Mois::class);

    }
}

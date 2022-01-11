<?php

namespace App\Models;

use App\Models\Annee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Mois extends Model
{
    use HasFactory;
    public $timestamps = FALSE;
    public function post()
    {
        return $this->belongsTo(Annee::class);
    }
}

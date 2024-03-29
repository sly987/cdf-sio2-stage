<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Statut extends Model
{
    use HasFactory;
    public $timestamps = FALSE;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}

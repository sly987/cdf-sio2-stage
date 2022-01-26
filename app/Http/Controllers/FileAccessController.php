<?php

namespace App\Http\Controllers;

use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileAccessController extends Controller
{
    public function download(Fiche $fiche)
    {
        if(Auth::user() AND Auth::id() === $fiche->user->id OR Auth::user()->admin == 1) {
            return Storage::download($fiche->chemin_fiche);
        }else{
            return abort('403');
        }
    }

    public function destroy($id)
    {
        $fiche = Fiche::findOrFail($id);
        $fiche->chemin_fiche = NULL;
        $fiche->envoye = 0;
        $fiche->update();

        return redirect(url()->previous());
    }
}

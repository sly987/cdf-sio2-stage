<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Notifications\FileDeletedNotification;

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
        $user = User::findOrFail($fiche->user_id);
        $user->notify(new FileDeletedNotification($user));

        //mettre un tableau associatif dans update avec ce qui est a mettre a jour
        $fiche->chemin_fiche = NULL;
        $fiche->envoye = 0;
        $fiche->update();

        return redirect(url()->previous());
    }
}

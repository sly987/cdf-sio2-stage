<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Annee;
use App\Models\Fiche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if($request->user()->can('view',Auth::user()))
        {
            $annee =\Session::get('anneeChoisie');
            return view('user.dashboard', [
                'annee'=>$annee,
                
            ]);
        }
    }

    public function show(Request $request, $id)
    {
        $prof = User::findOrFail($id);
        if($request->user()->can('view', $prof ))
        {
            $annee =Annee::all()->last();
            return view('user.show', [
                'annee'=>$annee,
                'prof'=>$prof
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'chemin_fiche'=> 'required',
        ]);

        $prof = Fiche::findOrFail($id);
        if($prof->mois->mois <= 9)
            $zero = '_0';
        else
            $zero = '_';
        $namevetting = $prof->mois->annee->annee . $zero . $prof->mois->mois . '_' . 'BP' . '_' . $prof->mois->libelle . '.pdf';

        $file = $request->file('chemin_fiche');
        $name = $file->getClientOriginalName(); 

        if($name != $namevetting)
        {
            return redirect('/dashboard')->with('status','La fiche n\'est pas correcte');
        }
        else
        {
            $privatedisk = Auth::user()->id . '_' . Auth::user()->nom . '_' . Auth::user()->prenom;
            $chemin_fiche = $request->file('chemin_fiche')->storeAs($privatedisk, $name);
        
            $prof->chemin_fiche = $chemin_fiche;
            $prof->envoye = 1; 
            $prof->update();
            return redirect('/dashboard')->with('status','La fiche est correcte et a été téléversé, elle est actuellement en attente de confirmation');
        }

    }
}

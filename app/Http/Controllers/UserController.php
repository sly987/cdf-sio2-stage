<?php

namespace App\Http\Controllers;

use Session;
use Carbon\Carbon;
use App\Models\Mois;
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
            //DashboardController fusionner avec UserManagement
            $annee =Session::get('anneeChoisie');
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
            return view('user.show', compact('annee', 'prof'));
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
        //fonction dans le helper dans le model Mois
        
            $zero=Mois::zerotation($prof);
            //changer $prof->mois->annee->annee en nom
        $namevetting = $prof->mois->annee->annee . $zero . $prof->mois->mois . '_' . 'BP' . '_' . $prof->mois->libelle . '.pdf';

        $file = $request->file('chemin_fiche');
        $name = $file->getClientOriginalName(); 

        if($name != $namevetting)
        {
            return redirect('/dashboard')->with('status','La fiche n\'est pas conforme : veuillez téléverser une fiche de ce type : 2021_12_BP_decembre.pdf');
        }
        else
        {
            $privatedisk = Auth::user()->id . '_' . Auth::user()->nom . '_' . Auth::user()->prenom;
            $chemin_fiche = $request->file('chemin_fiche')->storeAs($privatedisk, $name);
        
            $prof->chemin_fiche = $chemin_fiche;
            $prof->envoye = 1; 
            //tableau associatif
            $prof->update();
            return redirect('/dashboard')->with('status','La fiche est correcte et a été téléversée, elle est actuellement en attente de confirmation');
        }

    }
}

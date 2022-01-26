<?php

namespace App\Http\Controllers;

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
            $annee =Annee::all()->last();
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
        $validated = 1;
        $filename = date('Y') . '_' . date('M') . '_' . time() . '.' . $request->chemin_fiche->extension();
        $privatedisk = Auth::user()->id . '_' . Auth::user()->nom . '_' . Auth::user()->prenom;
        $chemin_fiche = $request->file('chemin_fiche')->storeAs($privatedisk, $filename);

        $prof = Fiche::findOrFail($id);
        $prof->chemin_fiche = $chemin_fiche;
        $prof->envoye = $validated; 
        $prof->update();
        return view('user.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

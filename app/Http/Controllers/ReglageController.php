<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use Illuminate\Http\Request;

class ReglageController extends Controller
{
    public function DonnerAnnee(Request $request)
    {
        if($request===null)
        {
            if($request->session()->missing('anneeChoisie'))
            session(['anneeChoisie' =>Annee::all()->last() ]); 
        }
        else
        session(['anneeChoisie' => $request->annee]);
        $request->session()->keep('anneeChoisie');
        $annees =Annee::pluck('annee', 'id');
        
        return view('reglage')->with('annees', $annees);
    }
}

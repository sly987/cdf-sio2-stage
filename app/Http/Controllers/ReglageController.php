<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use Illuminate\Http\Request;

class ReglageController extends Controller
{
    public function DonnerAnnee(Request $request)
    {
        $annees =Annee::pluck('annee', 'id');
        if($request->annee===null) //mettre un isset
        {
            return view('reglage')->with('annees', $annees);
        }
        else
        {
            session(['anneeChoisie' => $request->annee]);     
            return view('reglage')->with('annees', $annees);
        }
    }
}

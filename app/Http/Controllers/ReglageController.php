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
            return view('reglage')->with('annees', $annees);
        }
        session(['anneeChoisie' => $request->annee]);
            
        $annees =Annee::pluck('annee', 'id');
        
        return view('reglage')->with('annees', $annees);
    }
}

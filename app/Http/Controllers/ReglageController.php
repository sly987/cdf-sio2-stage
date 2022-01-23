<?php

namespace App\Http\Controllers;

use App\Models\Annee;
use Illuminate\Http\Request;

class ReglageController extends Controller
{
    public function DonnerAnnee(Request $request)
    {
        if($request ===null)
        {
            if($request->session()->get('anneeChoisie') ==null)
                $request->session()->put('anneeChoisie', Annee::class->last());
        }
        else
            $request->session()->put('anneeChoisie', $request->annee);
        $annees =Annee::pluck('annee', 'id');
        
        return view('reglage')->with('annees', $annees)
                              ->with('request', $request);
    }
}

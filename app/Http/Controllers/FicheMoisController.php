<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\User;
use App\Models\Annee;
use App\Models\Statut;
use App\Models\UserStatut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FicheMoisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->can('viewAny',User::class))
        {
          

            $profs = User::orderBy('nom')->paginate(10);
            $annees=Annee::pluck('annee', 'id');
                $libelle=array(
                    1=>"janvier",
                    2=>"fevrier",
                    3=>"mars",
                    4=>"avril",
                    5=>"mai",
                    6=>"juin",
                    7=>"juillet",
                    8=>"aout",
                    9=>"septembre",
                    10=>"octobre",
                    11=>"novembre",
                    12=>"decembre",
                );

            $statut=Statut::pluck('libelle', 'id');
                if($request->annee!=null)
                {
                    $mois=Mois::select('mois', 'id')->where('mois',$request->mois)
                                                    ->where('annee_id', $request->annee)
                                                    ->get();
                    
                    if(isset($request->statut))
                    {
                        $statutSelectionne= $request->statut;
                        $profStatut=UserStatut::select('user_id')->where('statut_id', '=', $statutSelectionne);
                                                 
                        $profs=User::whereIn('id', $profStatut)
                                          ->get();
                        return view('admin.listPM')->with('statut', $statut)
                                                   ->with('statutSelectionne', $statutSelectionne)
                                                   ->with('annees', $annees)
                                                   ->with('libelle', $libelle)
                                                   ->with('moisSelectionne', $request->mois)
                                                   ->with('anneeSelectionne', $request->annee)
                                                   ->with('users', $profs)
                                                   ->with('mois', $mois);
                    }
                    else
                    {
                                          
                            return view('admin.listPM')->with('statut', $statut)
                                                       ->with('statutSelectionne', null)
                                                       ->with('users',$profs)
                                                       ->with('annees', $annees)
                                                       ->with('libelle', $libelle)
                                                       ->with('moisSelectionne', $request->mois)
                                                       ->with('anneeSelectionne', $request->annee)
                                                       ->with('mois', $mois);
                    }

                }
                else
                {
                    return view('admin.listPM')->with('annees', $annees)
                                               ->with('libelle', $libelle)
                                               ->with('statut', $statut)
                                               ->with('statutSelectionne', null)
                                               ->with('moisSelectionne', null)
                                               ->with('anneeSelectionne', null);
                }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

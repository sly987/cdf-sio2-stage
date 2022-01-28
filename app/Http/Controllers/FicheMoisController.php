<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annee;
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
                if($request->annee!=null)
                {
                    $mois_id=DB::table('mois')->select('id')
                                              ->where('annee_id','=', Annee::find($request->annee)->id)
                                              ->where('mois', '=', $request->mois)
                                              ->get();
                    

                    return view('admin.listPM')->with('annees', $annees)
                                               ->with('libelle', $libelle)
                                               ->with('moisSelectionne', $request->mois)
                                               ->with('anneeSelectionne', $request->annee)
                                               ->with('users', User::all())
                                               ->with('mois_id', $mois_id);
                }
                else
                {
                    return view('admin.listPM')->with('annees', $annees)
                                               ->with('libelle', $libelle)
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

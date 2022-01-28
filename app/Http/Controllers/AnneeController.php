<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\User;
use App\Models\Annee;
use App\Models\Fiche;
use Illuminate\Http\Request;

class AnneeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->user()->can('create',User::class))
        {
            return view('admin.createAnnee');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $annee=new Annee;
        $annee->annee=(Annee::all()->last()->annee)+1;
        $annee->save();
        $t_mois = array(
            "janvier",
            "fevrier",
            "mars",
            "avril",
            "mai",
            "juin",
            "juillet",
            "aout",
            "septembre",
            "octobre",
            "novembre",
            "decembre",
        );
        $users=User::where('actif','=',1)->where('admin','=',0)->get();
        for($i=1;$i<=12;$i++)
        {
            $mois=new Mois;
            $mois->mois=$i;
            $mois->libelle=$t_mois[$i-1];
            $mois->annee_id=Annee::all()->last()->id;
            $mois->save();

            foreach($users as $user)
            {
                    $fiche=new Fiche;
                    $fiche->user_id=$user->id;
                    $fiche->actif = 1;
                    $fiche->mois_id=$i+12*(Annee::all()->last()->id-1);
                    $user->fiches()->save($fiche);
            }  

        }
        return redirect(route('annee.create'))->with('status','La création a été effectué');
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

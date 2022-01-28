<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\Annee;
use Illuminate\Http\Request;

class MoisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->can('viewAny', User::class ))
        {
            $annee =Annee::find(\Session::get('anneeChoisie'));
            return view('admin.DesactiverMois', [
                'annee'=>$annee,
            ]);
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
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        foreach(Annee::find(\Session::get('anneeChoisie'))->mois as $mois)
        {
            if($request->input($mois->mois)===null)
                $mois->actif= 0;
            else
                $mois->actif= $request->input($mois->mois);
            $mois->update();
        }

        return redirect(route('mois.index'))->with('status','La modification a été effectué');
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

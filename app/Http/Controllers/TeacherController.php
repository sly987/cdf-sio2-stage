<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annee;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    //Middleware : l'utilisateur doit etre connecté
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->can('view',User::class))
        {
            $annees = Annee::all();

            return view('user.history', [
                'annees' => $annees
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
        return view('user.upload');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $name = Storage::disk('local')->put('fiches', $request->fiche);
        // $filename = date(Y).'_'.date(m) . '_BP_' . date(F) . '.' . $request->fiche->extension();
        $filename = date("Y") . '_' . date("M") . '.' . $request->fiche->extension();
        dd($request->file('fiche')->storeAs(
            'fiches2',
            $filename
        )); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

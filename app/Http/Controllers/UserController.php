<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\User;
use App\Models\Annee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{

    //Doit etre connecté Middleware
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Page de connexion vers dashboard si connecté avec le middleware au dessus
    public function connexion()
    {
        return view('dashboard');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->authorize('viewAny', User::class );
        $profs = User::orderBy('nom')->paginate(10);
    
        return view('professeurs', [
            'profs' => $profs
        ]);


        // $users = User::all();
        // echo '<pre>' . var_export($users, true) . '</pre>';
        // highlight_string("<?php\n\$users =\n" . var_export($users,true) . ";\n?//>");
        // dd($users);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', User::class );
        return view('createform');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mdp = Str::random(10);
        User::create([
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'admin' => $request->admin,
            'password' => Hash::make($mdp),
        ]);

        return redirect('professeurs')->with('status','La modification a été effectué');
        // return view('createvalidate',[
        //     'mdp' => $mdp
        // ]);
        
    }

    public function fichecreate()
    {
        return view('televerse');
    }

    public function fichestore(Request $request)
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
    public function show($id)
    {
        $prof = User::findOrFail($id);
        $annees =Annee::all();

        return view('f_professeur', [
            'prof' => $prof,
            'annees' => $annees
        ]);
    }

    public function showuser()
    {
        $annees =Annee::all();

        return view('historique', [
            'annees' => $annees
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prof = User::findOrFail($id);
        return view('editform', [
            'prof' => $prof
        ]);
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
        $prof = User::findOrFail($id);
        
            $prof->email = $request->input('email');
            $prof->nom = $request->input('nom');
            $prof->prenom = $request->input('prenom');
            $prof->admin = $request->input('admin');
            $prof->update();

        return redirect('professeurs')->with('status','La modification a été effectué');
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

<?php

namespace App\Http\Controllers;

use App\Models\Mois;
use App\Models\User;
use App\Models\Annee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    //Middleware : Doit etre connecté 
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Page de connexion vers dashboard si connecté avec le middleware au dessus
    public function connexion()
    {
        return view('admin.dashboard');
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
    
        return view('admin.list', compact('profs'));


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
        return view('admin.create');
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
        $request->validate([
            'email'=>[
                'required',
                'email',
                'unique:users,email'
            ],
            'nom'=> 'required',
            'prenom'=> 'required',
        ]);
        User::create([
            'email' => $request->email,
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'admin' => $request->admin,
            'password' => Hash::make($mdp),
        ]);

        return redirect('admin')->with('status','La création a été effectué');
        // return view('createvalidate',[
        //     'mdp' => $mdp
        // ]);
        
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

        return view('admin.show', [
            'annees'=>$annees,
            'prof'=>$prof
        ]);
    }

    //Controller historique (à grouper)
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
        return view('admin.edit', [
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
 
        return redirect('admin')->with('status','La modification a été effectué');
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

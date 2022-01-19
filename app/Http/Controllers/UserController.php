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
    public function index(Request $request)
    {
        $profs = User::orderBy('nom')->paginate(10);
        if($request->user()->can('viewAny',User::class))
        {
    
            return view('admin.list', compact('profs'));
        }


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
    public function create(Request $request)
    {
        if($request->user()->can('create',User::class))
        {
            return view('admin.create');
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
    public function show(Request $request, $id)
    {
        $prof = User::findOrFail($id);
        if($request->user()->can('view', $prof))
        {
            $annee =Annee::all()->last();
            return view('admin.show', [
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
    public function edit(Request $request, $id)
    {
        $prof = User::findOrFail($id);
        if($request->user()->can('update', $prof))
        {
            return view('admin.edit', [
                'prof' => $prof
            ]);
        }
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

        $request->validate([
            'email'=>[
                'required',
                'email',
            ],
            'nom'=> 'required',
            'prenom'=> 'required',
        ]);
        
        // $prof = new User;

        // $prof->email = $request->email;
        // $prof->nom = $request->nom;
        // $prof->prenom = $request->prenom;
        // $prof->admin = $request->admin;
        // $prof->password = $request->password;
        // $prof->save();
        
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

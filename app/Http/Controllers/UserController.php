<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        
        if(Auth::User()->admin===1)
            return view('admin.dashboard');
        else
            return view('user.dashboard');
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
        $request->validate([
            'email'=>[
                'required',
                'email',
                'unique:users,email'
            ],
            'nom'=> 'required',
            'prenom'=> 'required',
        ]);
        $mdp = Str::random(8);

        $user = new User;

        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->admin = $request->admin;
        $user->email = $request->email;
        $user->password = bcrypt($mdp);

        $user->save();

        return redirect('user')->with('status','La création a été effectué');
        
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

        $prof->update($request->input());

        return redirect('user')->with('status','La modification a été effectué');
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

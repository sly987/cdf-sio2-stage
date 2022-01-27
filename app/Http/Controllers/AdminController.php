<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annee;
use App\Models\Fiche;
use Illuminate\Support\Str;
use App\Mail\MailCreateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Notifications\UserCreatedNotification;
use App\Notifications\FileConfirmedNotification;

class AdminController extends Controller
{


    //Page de connexion vers dashboard si connecté avec le middleware au dessus

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->user()->can('viewAny',User::class))
        {
            return view('admin.dashboard');
        }
    }

    public function list(Request $request)
    {
        $profs = User::orderBy('nom')->paginate(10);
        if($request->user()->can('viewAny',User::class))
        {
            return view('admin.list', compact('profs'));
        }
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
        $user->email = $request->email;
        if(Auth::user()->superAdmin == 1)
        {
            $user->admin = $request->admin;
        }
        else
        {
            $user->admin = 0;
        }
        $user->password = bcrypt($mdp);
        $user->save();

        //Notification quand un utilisateur est crée
        $user->notify(new UserCreatedNotification($user, $mdp));
        
        //Pour la génération des fiches apres la création de l'utisateur
        $annee =Annee::find(\Session::get('anneeChoisie'));
        
        if($request->admin == 0)
        {
            foreach($annee->mois as $mois)
            {
                $fiche = new Fiche;
                $fiche->user_id= User::all()->last()->id;
                $fiche->mois_id = $mois->id;
                $user->fiches()->save($fiche);
            }
        }

        return redirect('list')->with('status','La création a été effectué');
        
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

        if(Auth::user()->superAdmin == 1)
        {
            $prof->admin = $request->input('admin');
        }
        else
        {
            $prof->admin = $prof->admin;
        }
        $prof->update($request->input());

        return redirect('list')->with('status','La modification a été effectué');
    }

    public function confirmed($id)
    {
        $fiche = Fiche::findOrFail($id);
        $fiche->confirme = 1;
        $fiche->update();

        return redirect(url()->previous());
    }
}

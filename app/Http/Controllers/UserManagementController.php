<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Annee;
use App\Models\Fiche;
use App\Models\Statut;
use App\Models\UserStatut;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserCreatedNotification;

class UserManagementController extends Controller
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
            //DashboardController fusionner avec UserController
            return view('admin.dashboard');
        }
    }

    public function list(Request $request)
    {
        if($request->user()->can('viewAny',User::class))
        {
            $statut=Statut::pluck('libelle', 'id');
            
            $search = $request['search'] ?? "";
            if($search != "")
            {
                $profs = User::where('nom','LIKE',"%$search%")->orWhere('email','LIKE',"%$search%")->get();
                
            }
            else
            {
                $profs = User::orderBy('nom')->paginate(10);
            }
            if(isset($request->statut))
            {
                $statutSelectionne= $request->statut;
                $profStatut=UserStatut::select('user_id')->where('statut_id', '=', $statutSelectionne);
               
                $profs=DB::table('users')->whereIn('id', $profStatut)
                                         ->get();
                return view('admin.list', compact('profs'))->with('statut', $statut)
                                                            ->with('statutSelectionne', $statutSelectionne);
            }
            else
            {
                $statutSelectionne=Statut::all()->last();
        
                return view('admin.list', compact('profs'))->with('statut', $statut)
                                                        ->with('statutSelectionne', $statutSelectionne);
            }
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
        $user->actif=1;
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
                $fiche->actif=1;
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
//can policies
        if(Auth::user()->superAdmin == 1)
        {
            $prof->admin = $request->input('admin');
        }
        else
        {
            $prof->admin = $prof->admin;
        }
        if($request->actif===null)
                $prof->actif= 0;
        else
            $prof->actif= $request->actif;
        $prof->update($request->input());

        return redirect('list')->with('status','La modification a été effectué');
    }

    //policies
    public function confirmed($id)
    {
        $fiche = Fiche::findOrFail($id);
        $fiche->confirme = 1;
        $fiche->update();

        return redirect(url()->previous());
    }

    public function dactivemonth($id)
    {
        $fiche = Fiche::findOrFail($id);
        $fiche->actif = 0;
        $fiche->update();

        return redirect(url()->previous());
    }

    public function activemonth($id)
    {
        $fiche = Fiche::findOrFail($id);
        $fiche->actif = 1;
        $fiche->update();

        return redirect(url()->previous());
    }
}

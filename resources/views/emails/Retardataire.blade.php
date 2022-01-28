@component('mail::message')
    Voici la liste des retardataires :
    @foreach($users as $user)
        @foreach ($user->fiches as $fiche )
            @if($fiche->confirme==0 AND $fiche->mois->mois=$mois AND $fiche->mois->annee->annee==$annee AND $fiche->mois->actif==1 )
                {{$user->nom}}, {{$user->prenom}}<br>
            @endif
        @endforeach
             
    @endforeach   
@endcomponent
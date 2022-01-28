  <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3>La liste des retardataires de {{$mois}} {{$annee}}</h3>
                        @foreach($users as $user)
                        @forelse ($user->fiches as $fiche)
                            @if($fiche->chemin_fiche==NULL AND $fiche->mois->mois==$mois AND $fiche->mois->annee->annee==$annee AND $fiche->mois->actif==1 AND $user->admin==0)
                                {{$user->nom}}, {{$user->prenom}}, Email : {{$user->email}}<br>
                            @endif
                        @empty
                            <h4>Il n'y a aucun professeur en retard urgent ce mois</h4>
                        @endforelse
                    @endforeach   
                    </div>
                </div>
            </div>
        </div>
    </div>

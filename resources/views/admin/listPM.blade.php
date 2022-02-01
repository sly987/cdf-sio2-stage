<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Fiche par mois</h4>
        </h2>
    </x-slot>
    @if (session('status'))
    <div class="alert alert-success">
        <br>
        <h4 align="center">{{ session('status') }}</h4>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="p-6 bg-white border-b border-gray-200">
                        {!! Form::open(['route' => 'listeFiche.index', 'method' => 'get']) !!}
                    <div class="form-group" align="center">
                        {{ Form::select('annee', $annees, $anneeSelectionne) }}
                        {{ Form::select('mois', $libelle, $moisSelectionne) }}
                        {{ Form::select('statut', $statut, $statutSelectionne,['placeholder' => 'niveau non sélectionné'] ) }}
                        {{ Form::submit('Rechercher')}}
                    </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div>
                    <table cellpadding="10" cellspacing="0">
                        <thead>
                            <tr>
                                <th width='25%'>
                                    nom
                                </th width='25%'>
                                <th>
                                    prenom
                                </th>
                                <th width='25%'>
                                    Fiche
                                </th>
                                <th width='25%'>
                                    confirmé?
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @if(isset($users))
                                @foreach ($users as $user )
                                    @if($user->admin == 0)
                                    
                                        <tr>
                                            <td>
                                                {{$user->nom}}
                                            </td>
                                            <td>
                                                {{$user->prenom}}
                                            </td>
                                    
                                            @foreach ($user->fiches as $fiche)
                                                @if ($fiche->mois_id==$mois[0]->id)
                                                    <td> 
                                                                    
                                                        @if($fiche->envoye == 1 AND $fiche->chemin_fiche != NULL)
                                                            <a href="{{ route('file.download', $fiche->id) }}">&#x1F4E5</a>
                                                            @if($fiche->confirme == 0)
                                                                <a href="{{ route('file.destroy', $fiche->id) }}">&#x1F5D1</a>
                                                            @endif
                                                        @else
                                                            
                                                            @if($fiche->mois->annee->annee < date ('Y'))
                                                                <p>&#x1F553 Retard</p>
                                                            @else
                                                                @if($fiche->mois->mois < $moisEnCours AND $fiche->mois->annee->annee == date('Y'))
                                                                {{-- $fiche->mois->actif == 1 --}}
                                                                    <p>&#x1F553 Retard</p>
                                                                @else
                                                                    <p>&#x1F512</p>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td align="center">
                                                        @if($fiche->confirme == 1)
                                                            <p>&#x2705</p>
                                                        @else
                                                            @if($fiche->envoye == 1 AND $fiche->chemin_fiche != NULL)
                                                                <a href="{{ route('admin.confirmed', $fiche->id) }}">&#x274C</a>
                                                            @else
                                                                <p>&#x1F512</p>	
                                                            @endif
                                                        @endif
                                                    </td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

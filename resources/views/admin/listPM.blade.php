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
                        {{ Form::submit('Rechercher')}}
                    </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div>
                    <table>
                        <tr>
                            <td width='30%'>
                                nom
                            </td width='30%'>
                            <td>
                                prenom
                            </td>
                            <td width='30%'>
                                statut de la fiche
                            </td>
                        </tr>
                        @if(isset($users))
                            @foreach ($users as $user )
                                <tr>
                                    <td>
                                        {{$user->nom}}
                                    </td>
                                    <td>
                                        {{$user->prenom}}
                                    </td>
                                    @foreach ($user->fiches as $fiche)

                                        @if ($fiche->mois_id==$mois_id[0]->id)
                                            @if($fiche->envoye == 1 AND $fiche->chemin_fiche != NULL)
                                                <td><a href="{{ route('file.download', $fiche->id) }}">&#x1F4E5</a></td>
                                                @if($fiche->confirme == 0)
                                                   <td> <a href="{{ route('file.destroy', $fiche->id) }}">&#x1F5D1</a></td>
                                                @endif
                                            @else
                                                @if($fiche->mois->mois <= $moisEnCours)
                                                    <td>&#x1F553 Retard</td>
                                                @else
                                                    <td>&#x274C</td>
                                                @endif
                                            @endif 
                                        @endif
                                    @endforeach
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

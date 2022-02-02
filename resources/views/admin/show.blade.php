@extends('layouts.app')


@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        M. {{ $prof->nom }} {{ $prof->prenom }}     
        </h2>
    </div>
            <div class="container bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <a href="{{ route('manage.list') }}"><button>&#x21A9 Retour</button></a>
                <div class="p-6 bg-white border-b border-gray-200" align="center">
                    <h3>{{$anneeChoisie+$anneeDebut-1}}</h3>
                </div>

                <table>
                    <thead align="center">
                        <tr>
                            <th width="20%">
                                Mois
                            </th>
                            <th width="20%">
                                Fiche
                            </th>
                            <th width="20%">
                                Confirmé?
                            </th>   
                            <th width="20%">
                                Activé mois?
                            </th>                                     
                        </tr>
                    </thead>
                    @foreach($prof->fiches as $fiche)
                        @if($fiche->mois->annee_id == $anneeChoisie) 
                        {{-- $fiche->mois->actif==1 --}}
                            <tbody align="center">
                                <tr>
                                    <td>
                                        {{ $fiche->mois->libelle }}
                                    </td>
                                    <td>
                                        @if($fiche->envoye == 1 AND $fiche->chemin_fiche != NULL)
                                            <a href="{{ route('file.download', $fiche->id) }}">&#x1F4E5</a>
                                            @if($fiche->confirme == 0)
                                                <a href="{{ route('file.destroy', $fiche->id) }}">&#x1F5D1</a>
                                            @endif
                                        @else
                                            @if($fiche->mois->mois < $moisEnCours AND $anneeChoisie+$anneeDebut-1 == date('Y'))
                                                <p>&#x1F553 Retard</p>
                                            @else
                                                @if($anneeChoisie+$anneeDebut-1 < date ('Y'))
                                                {{-- $fiche->mois->actif == 1 --}}
                                                    <p>&#x1F553 Retard</p>
                                                @else
                                                    <p>&#x1F512</p>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($fiche->confirme == 1)
                                            <p>&#x2705</p>
                                        @else
                                            @if($fiche->envoye == 1 AND $fiche->chemin_fiche != NULL)
                                                <a href="{{ route('manage.confirmed', $fiche->id) }}">&#x274C</a>
                                            @else
                                                <p>&#x1F512</p>	
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($fiche->actif == 1)
                                            <a href="{{ route('manage.dactivemonth', $fiche->id) }}">&#x2705</a>
                                        @else
                                            <a href="{{ route('manage.activemonth', $fiche->id) }}">&#x274C</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
@endsection
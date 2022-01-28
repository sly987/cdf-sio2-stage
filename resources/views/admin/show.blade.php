<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        M. {{ $prof->nom }} {{ $prof->prenom }}     
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ url()->previous() }}"><button>&#x21A9 Retour</button></a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" align="center">
                    <h3>{{$anneeChoisie+$anneeDebut-1}}</h3>
                </div>

                <table>
                    <thead>
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
                            <tbody>
                                <tr>
                                    <td align="center">
                                        {{ $fiche->mois->libelle }}
                                    </td>
                                    <td align="center">
                                        @if($fiche->envoye == 1 AND $fiche->chemin_fiche != NULL)
                                            <a href="{{ route('file.download', $fiche->id) }}">&#x1F4E5</a>
                                            @if($fiche->confirme == 0)
                                                <a href="{{ route('file.destroy', $fiche->id) }}">&#x1F5D1</a>
                                            @endif
                                        @else
                                            @if($fiche->mois->mois <= $moisEnCours-1 AND $anneeChoisie+$anneeDebut-1 == date('Y'))
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
                                    <td align="center">
                                        @if($fiche->actif == 1)
                                            <a href="{{ route('admin.dactivemonth', $fiche->id) }}">&#x2705</a>
                                        @else
                                            <a href="{{ route('admin.activemonth', $fiche->id) }}">&#x274C</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        M. {{ $prof->nom }} {{ $prof->prenom }}     
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" align="center">
                            {{$anneeChoisie+$anneeDebut-1}}
                </div>

                <table>
                    <thead>
                        <tr>
                            <th width="30%">
                                Mois
                            </th>
                            <th width="30%">
                                Fiche
                            </th>
                            <th width="30%">
                                Envoyé?
                            </th>

                        </tr>
                    </thead>
                    
                    @foreach($prof->fiches as $fiche)

                        @if($fiche->mois->annee_id == $anneeChoisie)
                            <tbody>
                                <tr>
                                    <td align="center">
                                        {{ $fiche->mois->libelle }}
                                    </td>
                                    <td align="center">
                                        @if($fiche->envoye == 1 AND $fiche->chemin_fiche != "pathtest")
                                            <a href="{{ Storage::url($fiche->chemin_fiche) }}" download="$fiche->chemin_fiche">Télécharger</a>
                                        @else
                                            <p>&#x274C</p>
                                        @endif
                                    </td>
                                    <td align="center">
                                        {{ $fiche->envoye }}
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            HISTORIQUE
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200" align="center">
                {{ $annee->annee }}
                </div>
                <table>
                    <thead>
                        <tr>
                            <th width="30%">
                                Fiche
                            </th>
                            <th width="30%">
                                Envoyé?
                            </th>
                            <th width="30%">
                                Mois
                            </th>
                        </tr>
                    </thead>
                    @foreach($prof->fiches as $fiche)
                        @if($fiche->annee_id == $annee->id)
                    <tbody>
                        <tr>
                            <td align="center">
                                {{ $fiche->chemin_fiche }}
                            </td>

                            <td align="center">
                                {{ $fiche->{'envoye(O/N)'} }}
                            </td>
                            <td align="center">
                                {{ $fiche->mois_id }}
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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des professeurs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($profs->count()>0)
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Nom
                                </th>
                                <th>
                                    Prenom
                                </th>
                                <th>
                                    Mail
                                </th>
                            </tr>
                        </thead>
                        @foreach($profs as $prof)
                        <tbody>
                            <tr>
                                <td>
                                    {{ $prof->nom }}
                                </td>
                                <td>
                                    {{ $prof->prenom }}
                                </td>
                                <td>
                                    {{ $prof->email }}
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                        <span>Aucun compte n'a été crée</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Liste des professeurs</h4>
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

            <!-- Bouton création professeur -->
            <a href="{{ route('admin.create') }}"><button class="btn btn-warning">Ajouter prof</button></a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($profs->count()>0)
                    <table>
                        <thead>
                            <tr>
                                <th width="20%">
                                    Nom
                                </th>
                                <th width="20%">
                                    Prenom
                                </th>
                                <th width="20%">
                                    Mail
                                </th>
                                <th width="20%">
                                    Activité
                                </th>
                                <th width="10%">
                                    
                                </th>
                                <th width="10%">
                                    
                                </th>
                            </tr>
                        </thead>
                        @foreach($profs as $prof)
                        <tbody>
                            <tr>
                                <td align="center">
                                    {{ $prof->nom }}
                                </td>
                                <td align="center">
                                    {{ $prof->prenom }}
                                </td>
                                <td align="center">
                                    {{ $prof->email }}
                                </td>
                                <td align="center">
                                    Actif
                                </td>
                                <td align="center">
                                    <a href="{{ route('admin.show', $prof->id) }}">Voir fiches</a>
                                </td>
                                <td align="center">
                                    <a href="{{ route('admin.edit', $prof->id) }}">Modifier</a>
                                </td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    @else
                        <span>Aucun compte n'a été crée</span>
                    @endif
                </div>
                <ul class="pagination justify-content-center mb-4">
    {{$profs->links("pagination::bootstrap-4")}}
</ul>               
            </div>
        </div>
    </div>
</x-app-layout>

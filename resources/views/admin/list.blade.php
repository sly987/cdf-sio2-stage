@extends('layouts.app')


@section('content')
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Liste des professeurs</h4>
        </h2>

    @if (session('status'))
    <div class="alert alert-success">
        <br>
        <h4 align="center">{{ session('status') }}</h4>
    </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <a href="{{ url()->previous() }}"><button>&#x21A9 Retour</button></a>
           
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <form action="">
                {!! Form::open() !!}
                    <div class="form-group" align="center">
                        {{ Form::search('search', '', ['placeholder' => 'Rechercher par nom ou email']) }}
                        {{ Form::select('statut', $statut, $statutSelectionne,['placeholder' => 'niveau non sélectionné']) }}
            
                        {{ Form::submit('Rechercher')}}
                    </div>
                {!! Form::close() !!}
                <br>
                 <!-- Bouton création professeur -->
            <a href="{{ route('manage.create') }}">
                <button class="ml-3">
                    Ajouter prof
                </button>
            </a>
                <div class="container p-6 bg-white border-b border-gray-200">
                    <table cellpadding="2" cellspacing="0">
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
                                    Etat
                                </th>
                                <th width="10%">
                                    
                                </th>
                                <th width="10%">
                                    
                                </th>
                            </tr>
                        </thead>
                        @forelse($profs as $prof)
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
                                            @if($prof->actif == 1)
                                                <p>Actif</p>
                                            @else
                                                <p>Inactif</p>
                                            @endif
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('manage.show', $prof->id) }}">Voir fiches</a>                                            
                                        </td>
                                        <td align="center">
                                            <a href="{{ route('manage.edit', $prof->id) }}">Modifier</a>
                                        </td>
                                    </tr>
                                </tbody>
                        @empty
                            <span>Aucun compte n'a été crée</span>
                        @endforelse
                    </table>
                </div>
                    <ul class="pagination justify-content-center mb-4">
                </ul>               
@endsection
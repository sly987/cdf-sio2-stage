@extends('layouts.app')


@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Dashboard</h4>
        </h2>
    </div>
    @if (session('status'))
    <div class="alert alert-success">
        <br>
        <h4 align="center">{{ session('status') }}</h4>
    </div>
    @endif

            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class='text-red-500'>{{ $error }}</div>
                @endforeach
            @endif

            <div class="container">
                    Bonjour {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                    <div class="container p-6 bg-white border-b border-gray-200">
                        <br>
                        @forelse(Auth::user()->fiches as $fiche)
                   
                            @if($fiche->envoye == 0 AND $fiche->mois->annee_id == $anneeChoisie AND $fiche->mois->mois <= $moisEnCours AND $fiche->actif == 1)
                                
                                {{ $fiche->mois->libelle }}
                                {{ $fiche->mois->annee->annee }}
                                <br>
                                {!! Form::model($fiche, ['files'=>true,'method' =>'PUT', 'route'=>['manage.updatefiche', $fiche->id]]) !!}

                                {{ Form::label('chemin_fiche','Téléverser votre fiche de paie') }}
                                {{ Form::file('chemin_fiche') }}
                                <br>

                                {{ Form::submit('Valider') }}
                                {!! Form::close() !!}
                                <br>
                            @endif
                        @empty
                            <span>Vous n'avez aucune fiche à rendre</span>
                        @endforelse
                    </div>
                </div
@endsection

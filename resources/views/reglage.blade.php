@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Réglage
        </h2>
    </div>
    <div class="container">
        {!! Form::open(['route' => 'reglage', 'method' => 'post']) !!}

        {{ Form::label('annee','annee : ') }}
        {{ Form::select('annee', $annees, $anneeChoisie)}}
        {{ Form::submit('Valider')}}
        {!! Form::close() !!}
        <br>
        <a href="route('annee.create')"><button>Créer une nouvelle année</button></a>
    </div>
@endsection
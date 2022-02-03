@extends('layouts.app')


@section('content')
<div class="container">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Création d'une nouvelle année</h4>
        </h2>
</div>

    @if (session('status'))
    <div class="alert alert-success">
        <br>
        <h4 align="center">{{ session('status') }}</h4>
    </div>
    @endif
                <div class="container p-6 bg-white border-b border-gray-200">
                    <h4>Confirmer que vous voulez une nouvelle année</h4>
                    {!! Form::open(['route' => 'annee.store', 'method' => 'post']) !!}
                    {{form::submit('Valider')}}
                    {!! Form::close() !!}
                    <a href="{{ route('dashboard.index') }}">
                        Annuler
                    </a>
                </div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Modifier un utilisateur
    </h2>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="container p-6 bg-white border-b border-gray-200">
                    <a href="{{ url()->previous() }}"><button>&#x21A9 Retour</button></a>
                @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class='text-red-500'>{{ $error }}</div>
                        @endforeach
                    @endif

                    {!! Form::model($prof, ['method' =>'PUT', 'route'=>['manage.update', $prof->id]]) !!}

                        {{ Form::label('email','Email : ') }}
                        {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('nom','Nom : ') }}
                        {{ Form::text('nom', old('nom'), ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('prenom','Prenom : ') }}
                        {{ Form::text('prenom', old('prenom'), ['class' => 'form-control']) }}
                        <br>
                        

                        @foreach($statuts as $statut)
                                @if($userstatut->contains('statut_id', $statut->id))
                                    {{Form::label($statut->libelle,$statut->libelle)}} 
                                    {{Form::checkbox($statut->libelle, $statut->id, true)}}
                                    &#xA0
                                @else
                                    {{Form::label($statut->libelle,$statut->libelle)}} 
                                    {{Form::checkbox($statut->libelle, $statut->id)}}
                                    &#xA0
                                @endif
                        @endforeach

                        <br>
                        @if(Auth::user()->superAdmin == 1)
                        {{ Form::label('admin','Admin ? Oui ') }}
                        {{ Form::radio('admin','1', old('admin'))}}
                        {{ Form::label('admin','Non ') }}
                        {{ Form::radio('admin', '0', old('admin'))}}
                        <br><br>
                        @endif

                        @if($prof->actif==1)
                            Sera salarié pour l'année {{$anneeChoisie+$anneeDebut}} :
                            {{Form::checkbox('uactif', 1, true)}}
                        @else
                            Sera salarié pour l'année {{$anneeChoisie+$anneeDebut}} :
                            {{Form::checkbox('uactif', 1)}}
                        @endif
                        <br><br>
                        {{ Form::submit('Valider')}}
                    {!! Form::close() !!}
                </div>
@endsection

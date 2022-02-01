<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Creer un nouvel utilisateur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ url()->previous() }}"><button>&#x21A9 Retour</button></a>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class='text-red-500'>{{ $error }}</div>
                        @endforeach
                    @endif
                    {!! Form::open(['route' => 'admin.store', 'method' => 'post']) !!}

                        {{ Form::label('email','Email : ') }}
                        {{ Form::email('email', '', ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('nom','Nom : ') }}
                        {{ Form::text('nom', '', ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('prenom','Prenom : ') }}
                        {{ Form::text('prenom', '', ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('statut[]','Primaire : ') }}
                        {{Form::checkbox('statut[]', 1)}}

                        {{ Form::label('statut[]','College : ') }}
                        {{Form::checkbox('statut[]', 2)}}
                        &#xA0
                        {{ Form::label('statut[]','Lycée : ') }}
                        {{Form::checkbox('statut[]', 3)}}

                        {{ Form::label('statut[]','Campus : ') }}
                        {{Form::checkbox('statut[]', 4)}}
                        &#xA0
                        {{ Form::label('statut[]','Remplacant : ') }}
                        {{Form::checkbox('statut[]', 5)}}
                        <br>
                        @if(Auth::user()->superAdmin == 1)
                        {{ Form::label('admin','Admin ? Oui ') }}
                        {{ Form::radio('admin','1' )}}
                        {{ Form::label('admin','Non ') }}
                        {{ Form::radio('admin', '0', true)}}
                        <br>
                        @endif
                        <br>
                        Un mdp sera généré et envoyé automatiquement à l'adresse mail que vous aurez inscrit.<br><br>
                        {{ Form::submit('Valider')}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

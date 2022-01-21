<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier un utilisateur
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class='text-red-500'>{{ $error }}</div>
                        @endforeach
                    @endif

                    {!! Form::model($prof, ['method' =>'PUT', 'route'=>['user.update', $prof->id]]) !!}

                        {{ Form::label('email','Email : ') }}
                        {{ Form::email('email', old('email'), ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('nom','Nom : ') }}
                        {{ Form::text('nom', old('nom'), ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('prenom','Prenom : ') }}
                        {{ Form::text('prenom', old('prenom'), ['class' => 'form-control']) }}
                        <br>
                        {{ Form::label('admin','Admin ? Oui ') }}
                        {{ Form::radio('admin','1', old('admin'))}}
                        {{ Form::label('admin','Non ') }}
                        {{ Form::radio('admin', '0', old('admin'))}}
                        <br>

                        {{ Form::submit('Valider')}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

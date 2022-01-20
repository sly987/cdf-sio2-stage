<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Dashboard</h4>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Bonjour professeur n°{{ Auth::user()->id }}

                {!! Form::open(['route' => 'teacher.store', 'method' => 'post', 'files' => true]) !!}

                    {{ Form::label('fiche','Téléverser votre fiche de paie') }}
                    {{ Form::file('fiche') }}

                    {{ Form::submit('Valider') }}


                {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Création d'une nouvelle année</h4>
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
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h4>Confirmer que vous voulez une nouvelle année</h4>
                    {!! Form::open(['route' => 'annee.store', 'method' => 'post']) !!}
                    {{form::submit('validé')}}
                    {!! Form::close() !!}
                    <a href="{{ route('admin.index') }}">
                        annuler
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

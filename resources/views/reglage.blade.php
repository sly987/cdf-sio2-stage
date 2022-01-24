<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            reglage
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {!! Form::open(['route' => 'reglage', 'method' => 'post']) !!}

                    {{ Form::label('annee','annee : ') }}
                    {{ Form::select('annee', $annees, Session('anneeChoisie'))}}
                    {{ Form::submit('Valider')}}
                    {!! Form::close() !!}
                    {{-- @php
                        dd(Session::get('anneeChoisie'));
                    @endphp
                     --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

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


                    <div class="p-6 bg-white border-b border-gray-200">
                        @forelse(Auth::user()->fiches as $fiche)
                            @if($fiche->envoye == 0 AND $fiche->annee_id == 3)
                                {{ $fiche->annee->annee }}
                                {{ $fiche->mois->libelle }}
                                <br>
                                {!! Form::model($fiche, ['files'=>true,'method' =>'PUT', 'route'=>['teacher.update', $fiche->id]]) !!}

                                {{ Form::label('chemin_fiche','Téléverser votre fiche de paie') }}
                                {{ Form::file('chemin_fiche') }}
                                <br>

                                {{ Form::submit('Valider') }}
                                {!! Form::close() !!}
                                <br>
                            @endif
                        @empty
                            <span>Aucun doc a rendre bien joué</span>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Dashboard</h4>
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
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class='text-red-500'>{{ $error }}</div>
                @endforeach
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    Bonjour {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
                    <div class="p-6 bg-white border-b border-gray-200">
                        @forelse(Auth::user()->fiches as $fiche)
                   
                            @if($fiche->envoye == 0 AND $fiche->mois->annee_id == $anneeChoisie AND $fiche->mois->mois <= $moisEnCours AND $fiche->actif == 1)
                                
                                {{ $fiche->mois->libelle }}
                                {{ $fiche->mois->annee->annee }}
                                <br>
                                {!! Form::model($fiche, ['files'=>true,'method' =>'PUT', 'route'=>['user.update', $fiche->id]]) !!}

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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

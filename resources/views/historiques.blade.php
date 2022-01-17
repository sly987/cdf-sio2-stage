<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            HISTORIQUE
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                @foreach($annees as $annee)     
                <form action="{{ route('historique.showing' , ['id' => $annee->id]) }}">
                <select>
                    <option value="#">--Please choose an option--</option>
                    <option>{{ $annee->id }}</option>
                    @endforeach
                </select>
                <button type="submit">Valider</button>
                </form>
            </div>
            </div>
        </div>
    </div>
</x-app-layout>

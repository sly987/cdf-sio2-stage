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
                {{ $annees->id }}
                @forelse($annees->mois as $mois)
                    <div>{{ $mois->mois_id }}</div>
                    @empty
                    <span>Aucun mois cette année</span>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

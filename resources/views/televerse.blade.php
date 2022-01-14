<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                <form method="POST" action="{{ route('televerse.store') }}" enctype="multipart/form-data">
                    @csrf
                    <label for="fiche">Téléverser votre fiche de paie</label>

                        <input type="file" id="fiche" name="fiche" class="block my-2" accept="image/png, image/jpeg">
                        <button type="submit">Envoyer</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

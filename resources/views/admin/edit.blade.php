<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un utilisateur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.update',$prof->id) }}"> 
                    
                    @csrf
                    @method('PUT')
                        {{ ('Email : ') }}<input type="email" name="email" value="{{ $prof->email }}"></input><br>
                        {{ ('Nom : ') }}<input type="text" name="nom" value="{{ $prof->nom }}"><br>                   
                        {{ ('Prenom : ') }}<input type="text" name="prenom" value="{{ $prof->prenom }}"><br><br>
                        {{ ('Admin ? ') }}
                        <!-- @if($prof->admin==1)
                            <input type='radio' name='admin' value='1' checked> Oui
                            <input type='radio' name='admin' value='0'> Non<br><br>
                        @else
                            <input type='radio' name='admin' value='1'> Oui
                            <input type='radio' name='admin' value='0' checked> Non<br><br>
                        @endif -->
                        <input type='radio' name='admin' value='1' {{ $prof->admin == '1' ? 'checked' : '' }}> Oui
                        <input type='radio' name='admin' value='0' {{ $prof->admin == '0' ? 'checked' : '' }}> Non
                        <br><br>
                        
                        <button type="submit">Modifier</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

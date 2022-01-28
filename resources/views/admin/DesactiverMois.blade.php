<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <h4>Modification de mois</h4>
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
                    <div class="p-6 bg-white border-b border-gray-200">
                        <table>
                            <tr>
                                <td>mois</td>
                                <td>activé</td>
                                <td></td>
                            </tr>
                                @foreach ($annee->mois as $mois )
                                    <tr>
                                        <td>
                                            {{$mois->libelle}}
                                        </td>
                                        <td>
                                            {!! Form::model($mois, ['method' =>'PUT', 'route'=>['mois.update', $mois->id]]) !!}
                                            @if($mois->actif==1)
                                                {{Form::checkbox($mois->mois, 1, true)}}
                                            @else
                                                {{Form::checkbox($mois->mois, 1)}}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                
                        </table>
                        <br>
                        {{Form::submit('valider')}}
                                {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

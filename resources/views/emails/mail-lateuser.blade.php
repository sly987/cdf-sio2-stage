@component('mail::message')
Bonjour, {{ $user->nom }} {{ $user->prenom }}<br>

	Bonjour n'oubliez pas de déposer votre fiche de paie de {{$mois}}/{{$annee}}

@component('mail::button', ['url' => $url])
Acceder au site
@endcomponent

{{ config('app.name') }}
@endcomponent

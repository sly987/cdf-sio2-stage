@component('mail::message')
Bonjour, {{ $user->nom }} {{ $user->prenom }}<br>

	Identifiant : {{ $user->email }}
	Mot de passe : {{ $mdp }}
	Vous avez la possibilité de changer votre mot de passe ici si ce dernier ne vous convient pas.

@component('mail::button', ['url' => $url])
Acceder au site
@endcomponent

{{ config('app.name') }}
@endcomponent

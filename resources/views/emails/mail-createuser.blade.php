@component('mail::message')
Bonjour, {{ $data['nom'] }} {{ $data['prenom'] }}<br>

	Identifiant : {{ $data['email'] }}
	Mot de passe : {{ $data['password'] }}

@component('mail::button', ['url' => $url])
Se connecter
@endcomponent

{{ config('app.name') }}
@endcomponent

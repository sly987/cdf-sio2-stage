@component('mail::message')
Bonjour, {{ $user->nom }} {{ $user->prenom }}<br>

	Votre fiche de paie à bien été validé auprès d'un administrateur.
	Merci et bonne journée!

@component('mail::button', ['url' => $url])
Acceder au site
@endcomponent

{{ config('app.name') }}
@endcomponent

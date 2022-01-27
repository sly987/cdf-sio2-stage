@component('mail::message')
Bonjour, {{ $user->nom }} {{ $user->prenom }}<br>

	Nous avons le regret de vous que votre fiche n'a pas été confirmé par un administrateur.
	Entre autre car cette dernière ne correspondait pas à la date convenu.

@component('mail::button', ['url' => $url])
Acceder au site
@endcomponent

{{ config('app.name') }}
@endcomponent

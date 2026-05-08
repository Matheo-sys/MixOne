<x-mail::message>
# Nouveau message reçu ! ✉️

Bonjour {{ $message->destinataire->first_name ?? $message->destinataire->name }},

Vous avez reçu un nouveau message de la part de **{{ $message->expediteur->first_name }}** sur MixOne.

**Message :**
"{{ Str::limit($message->message, 150) }}"

Ne faites pas attendre votre interlocuteur ! Une réponse rapide augmente vos chances de finaliser une réservation.

<x-mail::button :url="route('dashboard.settings')">
Répondre au message
</x-mail::button>

À très vite,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

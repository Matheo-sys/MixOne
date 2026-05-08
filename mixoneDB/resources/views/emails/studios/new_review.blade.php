<x-mail::message>
# Nouvel avis reçu ! ⭐

Bonjour {{ $reservation->studio->proprietaire->first_name ?? $reservation->studio->proprietaire->name }},

Bonne nouvelle ! L'artiste **{{ $reservation->client->first_name }}** vient de laisser un avis sur sa session au studio **{{ $reservation->studio->name }}**.

**Note :** {{ $reservation->rating }} / 5

@if($reservation->comment)
**Commentaire :**
"{{ $reservation->comment }}"
@endif

Ces retours sont essentiels pour la visibilité de votre studio sur MixOne.

<x-mail::button :url="url('/studios/' . $reservation->studio->id)">
Voir mon studio
</x-mail::button>

Merci de votre confiance,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

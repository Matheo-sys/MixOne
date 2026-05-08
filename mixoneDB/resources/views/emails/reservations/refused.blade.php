<x-mail::message>
# Réservation non disponible 😕

Bonjour {{ $reservation->client->first_name }},

Nous sommes navrés de vous informer que le studio **{{ $reservation->studio->name }}** n'a pas pu confirmer votre demande pour le **{{ $reservation->date->format('d/m/Y') }}**.

**Remboursement :**
Rassurez-vous, le montant de votre réservation (**{{ number_format($reservation->price, 2) }} €**) a été intégralement remboursé sur votre compte bancaire (visible sous 3 à 5 jours ouvrés).

Ne restez pas sur une fausse note ! De nombreux autres studios sont disponibles sur MixOne.

<x-mail::button :url="url('/recherche')">
Trouver un autre studio
</x-mail::button>

À très vite sur MixOne,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

<x-mail::message>
# Réservation annulée 🛑

Bonjour,

La réservation pour la session au studio **{{ $reservation->studio->name }}** prévue le **{{ $reservation->date->format('d/m/Y') }}** a été annulée par {{ $cancelledBy === 'artist' ? "l'artiste" : "le propriétaire du studio" }}.

**Détails :**
- **Studio :** {{ $reservation->studio->name }}
- **Montant :** {{ number_format($reservation->price, 2) }} €

@if($cancelledBy === 'studio')
**Note pour l'artiste :** Le montant a été remboursé sur votre compte.
@endif

<x-mail::button :url="url('/dashboard')">
Accéder à mon tableau de bord
</x-mail::button>

L'équipe {{ config('app.name') }}
</x-mail::message>

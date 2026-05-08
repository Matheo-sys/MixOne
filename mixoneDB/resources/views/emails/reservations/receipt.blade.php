<x-mail::message>
# Merci pour votre réservation ! 🎸

Bonjour {{ $reservation->client->first_name }},

Votre paiement pour la séance au studio **{{ $reservation->studio->name }}** a bien été confirmé. Voici le récapitulatif de votre transaction.

### Détails de la réservation :
- **Studio :** {{ $reservation->studio->name }}
- **Date :** {{ $reservation->date->format('d/m/Y') }}
- **Créneau :** {{ $reservation->time_slot }} ({{ $reservation->number_of_hours }}h)

### Détails du paiement :
- **Montant total :** {{ number_format($reservation->price, 2) }} €
- **Mode de paiement :** Carte bancaire (via Stripe)
- **ID Transaction :** {{ $reservation->stripe_payment_id }}

Vous recevrez un second mail contenant votre **Code PIN** dès que le propriétaire du studio aura confirmé votre demande.

<x-mail::button :url="url('/dashboard/artiste/reservations')">
Voir ma réservation
</x-mail::button>

Bonne session,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

<x-mail::message>
# Paiement reçu ! 🎸

Bonjour {{ $reservation->client->first_name }},

Bonne nouvelle ! Votre paiement de **{{ number_format($reservation->price, 2) }} €** pour la séance au studio **{{ $reservation->studio->name }}** a bien été reçu.

### Détails de la séance :
- **Date :** {{ $reservation->date->format('d/m/Y') }}
- **Horaires :** {{ $reservation->time_slot }} ({{ $reservation->number_of_hours }}h)

**Et maintenant ?**
Le propriétaire du studio a été prévenu. Il doit maintenant confirmer votre demande. Dès qu'il l'aura fait, vous recevrez un second mail contenant votre **Code PIN** d'accès.

<x-mail::button :url="route('dashboard.artist.booking')">
Voir ma réservation
</x-mail::button>

Merci de votre confiance,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

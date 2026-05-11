<x-mail::message>
# Réservation Confirmée ! 🎉

Bonjour **{{ $reservation->client->first_name ?? 'Artiste' }}**,

Votre session au studio **{{ $reservation->studio->name }}** a été officiellement confirmée par le propriétaire !

### Détails de votre session :
* **Date :** {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
* **Créneau :** {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours)->format('H:i') }}
* **Adresse :** {{ $reservation->studio->address }}, {{ $reservation->studio->city }}

<x-mail::panel>
**VOTRE CODE PIN SECRET : {{ $reservation->pin_code }}**<br><br>
Ce code est la preuve de votre achat. **Ne le donnez pas à l'avance !**<br>
Donnez ce code en main propre au propriétaire une fois que vous êtes sur place au studio. Cela lui permettra de débloquer son paiement et de marquer la session comme terminée.
</x-mail::panel>

<x-mail::button :url="route('dashboard.artist.booking')">
Voir ma réservation
</x-mail::button>

Bonne session d'enregistrement !<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

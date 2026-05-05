<x-mail::message>
# Bonne nouvelle ! 🎉

Une nouvelle réservation vient d'être payée pour votre studio **{{ $reservation->studio->name }}**.

### Détails de la demande :
* **Artiste :** {{ $reservation->user->first_name }} {{ $reservation->user->last_name }}
* **Date :** {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
* **Créneau :** {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }} ({{ $reservation->number_of_hours }} heure(s))
* **Montant :** {{ $reservation->price }} €

<x-mail::button :url="route('dashboard.studio.booking')">
Voir et confirmer la réservation
</x-mail::button>

Vous devez confirmer cette réservation sur votre tableau de bord pour que l'artiste reçoive son code PIN.

Merci,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

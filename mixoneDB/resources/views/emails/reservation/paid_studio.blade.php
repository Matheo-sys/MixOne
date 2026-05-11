<x-mail::message>
# Nouvelle Réservation (Action Requise)

Bonjour **{{ $reservation->studio->user->first_name ?? 'Studio' }}**,

Bonne nouvelle ! L'artiste **{{ $reservation->client->first_name ?? 'Un artiste' }}** vient de payer pour une session dans votre studio **{{ $reservation->studio->name }}**.

### Détails de la session :
* **Date :** {{ \Carbon\Carbon::parse($reservation->time_slot)->format('d/m/Y') }}
* **Créneau :** {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours)->format('H:i') }}
* **Gains :** {{ number_format($reservation->price * (1 - (config('services.stripe.commission_rate', 10) / 100)), 2) }} € *(versés sur votre solde en attente)*

<x-mail::panel>
**IMPORTANT : Validation par Code PIN**<br>
Le jour de la session, l'artiste vous fournira un **Code PIN à 4 chiffres**. 
Vous devrez saisir ce code sur votre tableau de bord pour valider la session et débloquer vos gains vers votre solde disponible. Sans ce code, les fonds resteront bloqués.
</x-mail::panel>

Pour que la réservation soit confirmée, vous devez l'accepter depuis votre tableau de bord :

<x-mail::button :url="route('dashboard.studio.booking')">
Confirmer la réservation
</x-mail::button>

Merci de votre confiance,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

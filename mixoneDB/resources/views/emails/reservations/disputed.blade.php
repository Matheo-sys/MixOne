<x-mail::message>
# Litige signalé ⚖️

Bonjour,

Un litige a été signalé concernant la réservation au studio **{{ $reservation->studio->name }}** du **{{ $reservation->date->format('d/m/Y') }}**.

**Signalé par :** {{ $signaledBy === 'artist' ? "l'artiste" : "le propriétaire du studio" }}
**Motif :** {{ $reservation->dispute_reason }}

Les fonds liés à cette réservation ont été gelés temporairement. Notre équipe de médiation va examiner les détails et vous contactera par email sous 48h pour résoudre la situation.

<x-mail::button :url="url('/dashboard')">
Voir les détails sur mon tableau de bord
</x-mail::button>

Merci de votre patience,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

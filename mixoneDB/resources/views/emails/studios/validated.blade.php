<x-mail::message>
# Votre studio est en ligne ! 🎉

Bonjour {{ $studio->proprietaire->first_name ?? $studio->proprietaire->name }},

Excellente nouvelle ! Votre studio **{{ $studio->name }}** a été validé par nos administrateurs.

Il est désormais **en ligne** et visible par tous les artistes sur MixOne. Vous pouvez dès à présent recevoir des demandes de réservation et commencer à générer des revenus.

<x-mail::button :url="url('/studios/' . $studio->id)">
Voir mon studio en ligne
</x-mail::button>

Bonnes sessions !<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

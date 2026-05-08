<x-mail::message>
# Demande de création reçue ! 🚀

Bonjour {{ $studio->proprietaire->first_name ?? $studio->proprietaire->name }},

Bonne nouvelle ! Nous avons bien reçu votre demande de création pour le studio **{{ $studio->name }}**.

Votre studio est actuellement **en attente d'approbation** par nos administrateurs. Nous vérifions chaque fiche manuellement pour garantir la qualité de la plateforme MixOne. Cette étape prend généralement moins de 24 heures.

Dès que votre studio sera validé, il deviendra visible pour tous les artistes et vous recevrez un nouvel email de confirmation.

<x-mail::button :url="url('/dashboard/studio/my-studios')">
Gérer mon studio
</x-mail::button>

Merci de votre confiance,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

<x-mail::message>
# Quelques modifications sont nécessaires 🛠️

Bonjour {{ $studio->proprietaire->first_name ?? $studio->proprietaire->name }},

Notre équipe a examiné votre demande pour le studio **{{ $studio->name }}**. Malheureusement, nous ne pouvons pas encore le valider en l'état.

**Pourquoi ?**
{{ $reason ?? "Certaines informations sont manquantes ou ne respectent pas nos critères de qualité (photos, description, tarifs)." }}

Ne vous inquiétez pas, vous pouvez modifier votre fiche à tout moment pour nous la soumettre à nouveau.

<x-mail::button :url="url('/dashboard/studio/studios/' . $studio->id . '/modifier')">
Modifier mon studio
</x-mail::button>

À bientôt,<br>
L'équipe {{ config('app.name') }}
</x-mail::message>

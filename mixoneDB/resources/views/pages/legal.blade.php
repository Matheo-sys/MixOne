@extends('layouts.backend')

@section('content')
<section class="layout-pt-md layout-pb-lg mt-90">
    <div class="container">
        <div class="row justify-center text-center">
            <div class="col-xl-8 col-lg-10">
                <h1 class="text-30 fw-600">Mentions Légales</h1>
                <div class="text-15 text-light-1 mt-10">Dernière mise à jour : {{ date('d/m/Y') }}</div>
            </div>
        </div>

        <div class="row justify-center pt-60">
            <div class="col-xl-8 col-lg-10">
                <div class="text-15 lh-16">
                    <h2 class="text-20 fw-500 mb-20">1. Éditeur du site</h2>
                    <p class="mb-20">
                        Le site <strong>MixOne</strong> est édité par <strong>Elias Louhichi</strong>, agissant en tant que personne physique, domicilié à L'Haÿ-les-Roses (94240), France.
                    </p>
                    <p class="mb-40">
                        <strong>Directeur de la publication :</strong> Elias Louhichi<br>
                        <strong>Contact :</strong> mixone.contact@gmail.com
                    </p>

                    <h2 class="text-20 fw-500 mb-20">2. Hébergement</h2>
                    <p class="mb-40">
                        Le site est hébergé par la société <strong>[Ton Hébergeur, ex: OVHcloud / Heroku / Vercel]</strong>.<br>
                        Si le site est en local pour le projet : <em>Développement local (Environnement de test scolaire).</em>
                    </p>

                    <h2 class="text-20 fw-500 mb-20">3. Propriété intellectuelle</h2>
                    <p class="mb-40">
                        L'ensemble du contenu présent sur le site MixOne (textes, images, logos, icônes, logiciels) est la propriété exclusive de Elias Louhichi ou de ses partenaires. Toute reproduction, représentation, modification ou adaptation de tout ou partie des éléments du site, quel que soit le moyen ou le procédé utilisé, est interdite, sauf autorisation écrite préalable.
                    </p>

                    <h2 class="text-20 fw-500 mb-20">4. Limitation de responsabilité</h2>
                    <p class="mb-40">
                        MixOne est une plateforme de mise en relation. Elias Louhichi ne saurait être tenu pour responsable des dommages directs ou indirects résultant de l'utilisation du site ou des prestations effectuées par les studios partenaires. Chaque studio est responsable de ses propres prestations et de sa conformité fiscale.
                    </p>

                    <h2 class="text-20 fw-500 mb-20">5. Contact</h2>
                    <p class="mb-40">
                        Pour tout signalement de contenu illicite ou demande d'information, merci de nous contacter à l'adresse suivante : <strong>mixone.contact@gmail.com</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

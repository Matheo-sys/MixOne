@extends('layouts.backend')

@section('content')
<section class="layout-pt-md layout-pb-lg mt-90">
    <div class="container">
        <div class="row justify-center text-center">
            <div class="col-xl-8 col-lg-10">
                <h1 class="text-30 fw-600">Politique de Confidentialité</h1>
                <div class="text-15 text-light-1 mt-10">Dernière mise à jour : {{ date('d/m/Y') }}</div>
            </div>
        </div>

        <div class="row justify-center pt-60">
            <div class="col-xl-8 col-lg-10">
                <div class="text-15 lh-16">
                    <p class="mb-30">Chez MixOne, nous accordons une importance capitale à la protection de vos données personnelles. Cette politique détaille comment nous collectons, utilisons et protégeons vos informations dans le cadre de l'utilisation de notre plateforme.</p>

                    <h2 class="text-20 fw-500 mb-20">1. Données collectées</h2>
                    <p class="mb-20">Nous collectons les informations nécessaires au bon fonctionnement du service :</p>
                    <ul class="list-disc ml-20 mb-30">
                        <li>Informations de compte (Nom, email, mot de passe)</li>
                        <li>Profil Studio ou Artiste (Description, adresse, équipements, photos)</li>
                        <li>Données de paiement (Gérées par notre prestataire sécurisé Stripe)</li>
                        <li>Données techniques (Cookies, adresse IP pour la sécurité)</li>
                    </ul>

                    <h2 class="text-20 fw-500 mb-20">2. Utilisation des données</h2>
                    <p class="mb-20">Vos données sont utilisées pour :</p>
                    <ul class="list-disc ml-20 mb-30">
                        <li>La mise en relation entre artistes et studios</li>
                        <li>La gestion et la sécurisation des réservations</li>
                        <li>Le traitement des paiements et des factures</li>
                        <li>L'amélioration de l'expérience utilisateur sur MixOne</li>
                    </ul>

                    <h2 class="text-20 fw-500 mb-20">3. Partage des données</h2>
                    <p class="mb-30">Vos données ne sont jamais vendues à des tiers. Elles ne sont partagées qu'avec les acteurs nécessaires à la réalisation de la prestation (ex: Stripe pour le paiement, ou le studio/artiste concerné par une réservation).</p>

                    <h2 class="text-20 fw-500 mb-20">4. Vos droits (RGPD)</h2>
                    <p class="mb-40">Conformément au RGPD, vous disposez d'un droit d'accès, de rectification, de suppression et d'opposition au traitement de vos données. Pour exercer ces droits, vous pouvez nous contacter à <strong>privacy@mixone.com</strong> ou directement via vos paramètres de compte.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

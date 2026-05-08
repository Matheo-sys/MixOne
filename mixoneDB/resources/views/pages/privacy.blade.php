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
                    <p class="mb-30">La protection de votre vie privée est une priorité absolue pour MixOne. Cette politique de confidentialité explique comment nous traitons vos données personnelles conformément au Règlement Général sur la Protection des Données (RGPD).</p>

                    <h2 class="text-20 fw-500 mb-20">1. Responsable du traitement</h2>
                    <p class="mb-30">Le responsable du traitement des données est Elias Louhichi, éditeur de la plateforme MixOne, joignable à l'adresse email : <strong>mixone.contact@gmail.com</strong>.</p>

                    <h2 class="text-20 fw-500 mb-20">2. Données collectées</h2>
                    <p class="mb-20">Nous collectons uniquement les données nécessaires à la fourniture de nos services :</p>
                    <ul class="list-disc ml-20 mb-30 y-gap-10">
                        <li><strong>Identité</strong> : Nom, prénom, pseudonyme, date de naissance.</li>
                        <li><strong>Contact</strong> : Adresse email, numéro de téléphone, adresse postale.</li>
                        <li><strong>Profil professionnel</strong> : Descriptions des studios, photos, liste des équipements.</li>
                        <li><strong>Données financières</strong> : Les paiements sont gérés via <strong>Stripe Connect</strong>. Nous ne stockons aucun numéro de carte bancaire sur nos serveurs. Pour les propriétaires de studios, les données KYC (identité, IBAN) sont gérées directement par Stripe.</li>
                    </ul>

                    <h2 class="text-20 fw-500 mb-20">3. Finalités du traitement</h2>
                    <p class="mb-20">Vos données sont collectées pour :</p>
                    <ul class="list-disc ml-20 mb-30 y-gap-10">
                        <li>La création et la gestion de votre compte utilisateur.</li>
                        <li>La mise en relation entre Artistes et Studios de musique.</li>
                        <li>Le traitement sécurisé des paiements et des commissions.</li>
                        <li>L'envoi de notifications relatives à vos réservations (emails transactionnels).</li>
                    </ul>

                    <h2 class="text-20 fw-500 mb-20">4. Vos droits (Conformité RGPD)</h2>
                    <p class="mb-20">Conformément à la réglementation européenne, vous disposez de droits étendus que nous avons intégrés directement dans vos paramètres de compte :</p>
                    <ul class="list-disc ml-20 mb-30 y-gap-10">
                        <li><strong>Droit d'accès et de portabilité</strong> : Vous pouvez télécharger une copie de vos données personnelles au format JSON directement depuis votre tableau de bord.</li>
                        <li><strong>Droit de rectification</strong> : Vous pouvez modifier vos informations à tout moment via votre profil.</li>
                        <li><strong>Droit à l'effacement (Droit à l'oubli)</strong> : Vous pouvez demander la suppression de votre compte. Pour garantir l'historique financier des transactions, vos données seront <strong>anonymisées</strong> (remplacées par des mentions "Utilisateur Anonyme") et vos fichiers personnels seront supprimés.</li>
                        <li><strong>Droit d'opposition</strong> : Vous pouvez refuser les cookies non-essentiels via notre bannière de consentement.</li>
                    </ul>

                    <h2 class="text-20 fw-500 mb-20">5. Conservation des données</h2>
                    <p class="mb-30">Vos données personnelles sont conservées tant que votre compte est actif. En cas d'inactivité prolongée de plus de 3 ans, vos données personnelles identifiables sont supprimées ou anonymisées.</p>

                    <h2 class="text-20 fw-500 mb-20">6. Contact</h2>
                    <p class="mb-40">Pour toute question relative à vos données, contactez-nous à <strong>mixone.contact@gmail.com</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

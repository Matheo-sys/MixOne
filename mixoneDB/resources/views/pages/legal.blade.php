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
                        Le site MixOne est édité par <strong>Elias Louhichi</strong>, agissant en tant que personne physique, domicilié à L'Haÿ-les-Roses (94240).
                    </p>
                    <p class="mb-40">
                        <strong>Directeur de la publication :</strong> Elias Louhichi
                    </p>

                    <h2 class="text-20 fw-500 mb-20">2. Hébergement</h2>
                    <p class="mb-40">
                        Le site est hébergé par la société <strong>[Hébergeur, ex: OVHcloud / AWS / Vercel]</strong>, dont le siège social est situé à [Adresse hébergeur].
                    </p>

                    <h2 class="text-20 fw-500 mb-20">3. Propriété intellectuelle</h2>
                    <p class="mb-40">
                        L'ensemble du contenu présent sur le site MixOne (textes, images, logos, icônes, sons, logiciels) est la propriété exclusive de l'éditeur ou de ses partenaires. Toute reproduction, représentation, modification ou adaptation de tout ou partie des éléments du site est strictement interdite sans autorisation écrite préalable.
                    </p>

                    <h2 class="text-20 fw-500 mb-20">4. Contact</h2>
                    <p class="mb-40">
                        Pour toute question ou demande d'information concernant le site, vous pouvez nous contacter à l'adresse suivante : <strong>mixone.contact@gmail.com</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

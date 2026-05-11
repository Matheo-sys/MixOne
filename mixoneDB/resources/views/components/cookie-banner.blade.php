<div id="cookie-banner" class="cookie-banner bg-white shadow-2 px-30 py-30 rounded-8" style="position: fixed; bottom: 20px; left: 20px; right: 20px; z-index: 10000; display: none;">
    <div class="row y-gap-20 justify-between items-center">
        <div class="col-xl-8 col-lg-9">
            <h5 class="text-18 fw-600">🍪 Votre vie privée nous tient à cœur</h5>
            <p class="text-15 text-light-1 mt-10">
                Nous utilisons des cookies pour améliorer votre expérience sur MixOne, analyser le trafic et vous proposer des contenus adaptés. En cliquant sur "Tout accepter", vous consentez à l'utilisation de tous les cookies. Vous pouvez consulter notre <a href="{{ route('privacy') }}" class="text-blue-1 underline">Politique de confidentialité</a> pour plus de détails.
            </p>
        </div>
        <div class="col-xl-4 col-lg-3">
            <div class="d-flex flex-wrap y-gap-10 x-gap-20 justify-end md:justify-center">
                <button class="button -md bg-blue-1 text-white js-accept-cookies px-30" style="min-width: 130px;">Accepter</button>
                <button class="button -md bg-light-2 text-dark-1 js-refuse-cookies px-30" style="min-width: 130px;">Refuser</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('js/components/cookie-banner.js') }}"></script>
@endpush

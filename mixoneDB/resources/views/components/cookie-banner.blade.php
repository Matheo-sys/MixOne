<div id="cookie-banner" class="cookie-banner bg-white shadow-2 px-30 py-30 rounded-8" style="position: fixed; bottom: 20px; left: 20px; right: 20px; z-index: 10000; display: none;">
    <div class="row y-gap-20 justify-between items-center">
        <div class="col-xl-8 col-lg-9">
            <h5 class="text-18 fw-600">🍪 Votre vie privée nous tient à cœur</h5>
            <p class="text-15 text-light-1 mt-10">
                Nous utilisons des cookies pour améliorer votre expérience sur MixOne, analyser le trafic et vous proposer des contenus adaptés. En cliquant sur "Tout accepter", vous consentez à l'utilisation de tous les cookies. Vous pouvez consulter notre <a href="{{ route('privacy') }}" class="text-blue-1 underline">Politique de confidentialité</a> pour plus de détails.
            </p>
        </div>
        <div class="col-xl-4 col-lg-3">
            <div class="d-flex justify-center lg:justify-end items-center" style="gap: 15px;">
                <button onclick="acceptCookies()" class="button h-50 bg-blue-1 text-white rounded-4 fw-500" style="line-height: 50px !important; min-width: 160px !important; padding: 0 !important; display: block !important; text-align: center !important;">Tout accepter</button>
                <button onclick="refuseCookies()" class="button h-50 bg-light-2 text-dark-1 rounded-4 fw-500" style="line-height: 50px !important; min-width: 160px !important; padding: 0 !important; display: block !important; text-align: center !important;">Refuser</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!localStorage.getItem('cookies_accepted')) {
            document.getElementById('cookie-banner').style.display = 'block';
        }
    });

    function acceptCookies() {
        localStorage.setItem('cookies_accepted', 'true');
        document.getElementById('cookie-banner').style.display = 'none';
    }

    function refuseCookies() {
        localStorage.setItem('cookies_accepted', 'refused');
        document.getElementById('cookie-banner').style.display = 'none';
    }
</script>

<!DOCTYPE html>
<html lang="fr" data-x="html" data-x-toggle="html-overflow-hidden">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('vendor/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">


    <!-- SEO Meta Tags -->
    <title>@yield('title', 'MixOne | Réservez le studio de musique idéal près de chez vous')</title>
    <meta name="description" content="@yield('meta_description', 'MixOne est la plateforme leader pour trouver et réserver des studios d\'enregistrement, de mixage et de mastering. Trouvez le meilleur équipement au meilleur prix.')">
    <meta name="keywords" content="studio musique, enregistrement, mixage, mastering, location studio, MixOne">
    <meta name="author" content="MixOne">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'MixOne | Réservez le studio de musique idéal')">
    <meta property="og:description" content="@yield('meta_description', 'Réservez votre studio de musique en quelques clics sur MixOne.')">
    <meta property="og:image" content="{{ asset('media/img/general/og-image.png') }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title" content="@yield('title', 'MixOne | Réservez le studio de musique idéal')">
    <meta property="twitter:description" content="@yield('meta_description', 'Réservez votre studio de musique en quelques clics sur MixOne.')">
    <meta property="twitter:image" content="{{ asset('media/img/general/og-image.png') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Structured Data (JSON-LD) -->
    @yield('structured_data')
</head>

<body>
    <div class="preloader js-preloader">
        <div class="preloader__wrap">
            <div class="preloader__icon">
                <figure>
                    <img src="{{ asset('media/images/preloader.svg') }}" alt="preloader">
                </figure>
            </div>
        </div>

        <div class="preloader__title">MixOne</div>
    </div>
    @include('components.header', ['whiteHeader' => isset($whiteHeader) ? $whiteHeader : true])

    <main class="{{ isset($isHome) && $isHome ? 'is-home-page' : 'is-not-home' }}">
        @yield('content')

        @include('components.footer')

        @include('components.lang-selector')
    </main>




<script src="{{ asset('vendor/js/vendors.js') }}"></script>
{{-- Empêche le plantage global de main.js qui attend google.maps.OverlayView --}}
<script>
    if (typeof window.google === 'undefined') {
        window.google = { 
            maps: { 
                OverlayView: class {}, 
                Map: class {}, 
                Marker: class {}, 
                InfoWindow: class {},
                LatLng: class {},
                event: { addDomListener: () => {}, trigger: () => {}, addListener: () => {} }
            } 
        };
    }
</script>
<script src="{{ asset('vendor/js/main.js') }}"></script>
    <div id="toast-container" style="position:fixed;top:20px;right:20px;z-index:9999;pointer-events:none;"></div>
    @auth
        @include('components.message-widget')
    @endauth
    <script src="{{ asset('js/ajax-forms.js') }}"></script>
    @stack('scripts')
</body>

</html>

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


    <title>MixOne</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <main>
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
    @include('components.message-widget')
    <script src="{{ asset('js/ajax-forms.js') }}"></script>
    @stack('scripts')
</body>

</html>

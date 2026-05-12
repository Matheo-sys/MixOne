<!DOCTYPE html>
<html lang="fr" data-x="html" data-x-toggle="html-overflow-hidden">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#3554D1">

    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('vendor/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-compiled.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>MixOne</title>

    <style>
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            pointer-events: none;
        }
    </style>
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
@include('components.headerDB')

<main>
    <div class="dashboard mt-90" data-x="dashboard" data-x-toggle="-is-sidebar-open">
        @if(Str::contains(Route::currentRouteName(), 'studio'))
            @include('components.sidebar-studio')
        @else
            @include('components.sidebar-artist')
        @endif

        <div class="dashboard__main">
            <div class="dashboard__content bg-light-2">
                @yield('content')

                @include('components.footer')
            </div>
        </div>
    </div>



    @include('components.lang-selector')
</main>



<!-- JavaScript -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

<script src="{{ asset('vendor/js/vendors.js') }}"></script>
<script src="{{ asset('vendor/js/main.js') }}"></script>
    <div id="toast-container"></div>

    @auth
        @include('components.message-widget')
    @endauth
    <script src="{{ asset('js/ajax-forms.js') }}"></script>
    @stack('scripts')
</body>

</html>

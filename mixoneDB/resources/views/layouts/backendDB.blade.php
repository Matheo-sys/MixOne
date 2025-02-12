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
    @yield('content')

    @include('components.footer')

    @include('components.lang-selector')
</main>



<!-- JavaScript -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAz77U5XQuEME6TpftaMdX0bBelQxXRlM"></script>
<script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

<script src="{{ asset('vendor/js/vendors.js') }}"></script>
<script src="{{ asset('vendor/js/main.js') }}"></script>
</body>

</html>

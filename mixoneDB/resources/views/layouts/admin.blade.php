<!DOCTYPE html>
<html lang="fr" data-x="html" data-x-toggle="html-overflow-hidden">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('vendor/css/vendors.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main-compiled.css') }}">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Admin Panel') - MixOne</title>

    <style>
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            pointer-events: none;
        }

        /* Force visibility of action buttons in tables */
        .table-3 td .button, 
        .table-3 td button, 
        .table-3 td a,
        .table-3 td form button {
            opacity: 1 !important;
            visibility: visible !important;
            display: inline-flex !important;
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

    <div class="preloader__title">MixOne Admin</div>
</div>
{{-- @include('components.headerDB') --}}

<main>
    <div class="dashboard pt-30" data-x="dashboard" data-x-toggle="-is-sidebar-open">
        @include('components.sidebar-admin')

        <div class="dashboard__main">
            <div class="dashboard__content bg-light-2">
                
                @if(session('success'))
                    <div class="px-20 py-15 mb-20 bg-green-1-05 text-green-2 rounded-4 text-14">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="px-20 py-15 mb-20 bg-red-1-05 text-red-1 rounded-4 text-14">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')

                @include('components.footer')
            </div>
        </div>
    </div>

    @include('components.lang-selector')
</main>

<!-- JavaScript -->
<script src="{{ asset('js/bootstrap-maps-mock.js') }}"></script>
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

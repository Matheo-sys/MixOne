@php
    $headerClass = $whiteHeader ? 'data-add-bg="" class="header bg-white js-header"' : 'data-add-bg="bg-dark-1" class="header js-header"';
    $btn1Class      = $whiteHeader ? 'bg-dark-1 text-white' : 'bg-white text-dark-1';
    $btn2Class      = $whiteHeader ? '-outline-dark-1 text-back' : 'border-white text-white';
@endphp
<header {!! $headerClass !!} data-x="header" data-x-toggle="is-menu-opened">
    <div data-anim="fade" class="header__container px-30 sm:px-20">
        <div class="row justify-between items-center">

            <div class="col-auto">
                <div class="d-flex items-center">
                    <a href="/" class="header-logo mr-20" data-x="header-logo" data-x-toggle="is-logo-dark">
                        <img src = {{  $whiteHeader ? asset("media/images/logo_droit.svg") : asset("media/images/Logo_white.png") }} alt="logo icon">
                    </a>

                    <div class="header-menu " data-x="mobile-menu" data-x-toggle="is-menu-active">
                        <div class="mobile-overlay"></div>

                        <div class="header-menu__content">
                            <div class="mobile-bg js-mobile-bg"></div>

                            <div class="menu js-navList">
                                <ul class="menu__nav {{ $whiteHeader ? 'text-dark-1' : 'text-white' }} -is-active">

                                    <li>
                                        <a href="/">
                                            <span class="mr-10">Accueil</span>
                                        </a>
                                    </li>


                                    <li>
                                        <a href="/studio_list">
                                            <span class="mr-10">Nos studios</span>
                                        </a>
                                    </li>

                                    @auth
                                    <li>
                                        <a href="/dashboard">Tableau de Bord</a>
                                    </li>
                                    @endauth

                                    <li>
                                        <a href="/about">
                                            À propos
                                        </a>
                                    </li>

                                    <li>
                                        <a href="/contact">Contacts</a>
                                    </li>

                                    @guest
                                        <li class="mobile-only-link border-top-light pt-10 mt-10">
                                            <a href="/login">Inscription / Se connecter</a>
                                        </li>
                                        <li class="mobile-only-link">
                                            <a href="/become-expert" class="text-blue-1 fw-600">Devenez un Studio Confirmé</a>
                                        </li>
                                    @endguest

                                    @auth()

                                        <li class="mobile-only-link border-top-light pt-10 mt-10">
                                            <a href="/"
                                               onclick="event.preventDefault();
                                               document.getElementById('logout-form-mobile').submit();"
                                               class="text-red-1">
                                                Déconnexion
                                            </a>
                                            <form id="logout-form-mobile" action="{{ route('logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    @endauth
                                </ul>
                            </div>

                            <div class="mobile-footer px-20 py-20 border-top-light js-mobile-footer">
                            </div>
                        </div>
                    </div>

                </div>
            </div>


            <div class="col-auto">
                <div class="d-flex items-center">



                    @guest
                        <div class="d-flex items-center ml-20 is-menu-opened-hide desktop-only-header">
                            <a href="/become-expert" class="button px-30 fw-400 text-14 -white {!! $btn1Class !!} h-50">Devenez un Studio Confirmé</a>
                            <a href="/login" class="button px-30 fw-400 text-14 -md -blue-1 {!! $btn2Class !!} -outline-white h-50 ml-20">Inscription / Se connecter</a>
                        </div>
                    @else
                        <div class="d-flex items-center ml-20 is-menu-opened-hide desktop-only-header">
                            <a href="/" 
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                               class="button px-30 fw-400 text-14 -md -blue-1 {!! $btn2Class !!} -outline-white h-50 ml-20">Déconnexion</a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endguest

                    <style>
                        @media (max-width: 1199px) { 
                            .mobile-nav-icons { display: flex !important; } 
                            .desktop-only-header { display: none !important; }
                        } 
                        @media (min-width: 1200px) { 
                            .mobile-nav-icons { display: none !important; } 
                            .mobile-only-link { display: none !important; } 
                            .desktop-only-header { display: flex !important; }
                        }
                    </style>
                    <div class="mobile-nav-icons x-gap-20 items-center pl-30 {{ $whiteHeader ? 'text-black' : 'text-white' }}" data-x="header-mobile-icons" data-x-toggle="text-white">
                        <div><button class="d-flex items-center icon-menu text-inherit text-20" data-x-click="html, header, header-logo, header-mobile-icons, mobile-menu"></button></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</header>

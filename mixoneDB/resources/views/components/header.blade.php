@php
    $headerClass    = $whiteHeader ? 'data-add-bg="" class="header bg-white js-header"' :
                                    'data-add-bg="bg-dark-1" class="header bg-green js-header"';
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

                                    <li>
                                        <a href="/about">
                                            À propos
                                        </a>
                                    </li>

                                    @auth()
                                    <li>
                                        <a href="/dashboard">
                                            <span class="mr-10">Tableau de Bord</span>
                                        </a>
                                    </li>
                                    @endif

                                    <li>
                                        <a href="/contact">Contacts</a>
                                    </li>
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

                    <div class="row x-gap-20 items-center xxl:d-none">
                        <div class="col-auto">
                            <button class="d-flex items-center text-14 {{ $whiteHeader ? 'text-dark-1' : 'text-white' }}"
                                    data-x-click="lang">
                                <img src={{asset("media/img/general/lang.png")}} alt="image" class="rounded-full mr-10">
                                <span class="js-language-mainTitle">United Kingdom</span>
                                <i class="icon-chevron-sm-down text-7 ml-15"></i>
                            </button>
                        </div>
                    </div>


                    @guest

                    <div class="d-flex items-center ml-20 is-menu-opened-hide md:d-none">
                        <a href="/become-expert" class="button px-30 fw-400 text-14 -white {!! $btn1Class !!} h-50">Devenez un Studio Confirmé</a>
                        <a href="/login" class="button px-30 fw-400 text-14 -md -blue-1 {!! $btn2Class !!} -outline-white h-50 ml-20">Inscription / Se connecter</a>
                    </div>

                    <div class="d-none xl:d-flex x-gap-20 items-center pl-30 {{ $whiteHeader ? 'text-black' : 'text-white' }} data-x="header-mobile-icons" data-x-toggle="text-white">
                        <div><a href="/login" class="d-flex items-center icon-user text-inherit text-22"></a></div>
                        <div><button class="d-flex items-center icon-menu text-inherit text-20" data-x-click="html, header, header-logo, header-mobile-icons, mobile-menu"></button></div>
                    </div>
                    @else
                        <div class="d-flex items-center ml-20 is-menu-opened-hide md:d-none">
                            <a href="/"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
                               class="button px-30 fw-400 text-14 -md -blue-1 {!! $btn2Class !!} -outline-white h-50 ml-20">Déconnexion</a>
                        </div>

                        <div class="d-none xl:d-flex x-gap-20 items-center pl-30 {{ $whiteHeader ? 'text-black' : 'text-white' }}" data-x="header-mobile-icons" data-x-toggle="text-white">
                            <div><a href="#" class="d-flex items-center icon-user text-inherit text-22"></a></div>
                        </div>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
</header>

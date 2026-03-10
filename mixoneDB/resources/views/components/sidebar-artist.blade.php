<div class="dashboard__sidebar bg-white scroll-bar-1">
    <div class="sidebar -dashboard">
        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs(['dashboard', 'dashboard.artist.booking']) ? '-is-active' : '' }}">
                <a href="{{route('dashboard.artist.booking')}}" class="d-flex items-center text-15 lh-1 fw-500 ">
                    <img src="{{asset('media/img/dashboard/sidebar/booking.svg')}}" alt="image" class="mr-15">
                    Historique des réservations
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('wishlist.index') ? '-is-active' : '' }}">
                <a href="{{route('wishlist.index')}}" class="d-flex items-center text-15 lh-1 fw-500">
                    <img src="{{asset('media/img/dashboard/sidebar/bookmark.svg')}}" alt="image" class="mr-15">
                    Liste d'envie
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('dashboard.settings') ? '-is-active' : '' }}">
                <a href="{{route('dashboard.settings')}}" class="d-flex items-center text-15 lh-1 fw-500">
                    <img src="{{asset('media/img/dashboard/sidebar/gear.svg')}}" alt="image" class="mr-15">
                    Paramètres
                </a>
            </div>
        </div>

        <div class="sidebar__item mt-20 pt-20" style="border-top: 1px solid #eee;">
            <div class="text-11 fw-500 text-light-1 uppercase mb-10 pl-15">Navigation Site</div>
            <div class="sidebar__button">
                <a href="{{ url('/') }}" class="d-flex items-center text-15 lh-1 fw-500">
                    <i class="icon-home text-20 mr-15"></i>
                    Accueil
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button">
                <a href="{{ route('studio_list') }}" class="d-flex items-center text-15 lh-1 fw-500">
                    <i class="icon-search text-20 mr-15"></i>
                    Nos studios
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button">
                <a href="{{ route('about') }}" class="d-flex items-center text-15 lh-1 fw-500">
                    <i class="icon-info text-20 mr-15"></i>
                    À propos
                </a>
            </div>
        </div>

        <div class="sidebar__item mt-10">
            <a href="/"
               onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
               class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                <img src="{{ asset('media/img/dashboard/sidebar/log-out.svg') }}" alt="image" class="mr-15">
                Se Déconnecter
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

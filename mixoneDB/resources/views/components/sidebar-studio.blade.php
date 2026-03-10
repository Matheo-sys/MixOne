<div class="dashboard__sidebar bg-white scroll-bar-1">
    <div class="sidebar -dashboard">
        <div class="sidebar__item">
            <a href="{{route('dashboard.studio')}}"
               class="sidebar__button d-flex items-center text-15 lh-1 fw-500 {{ request()->routeIs('dashboard.studio') ? '-is-active' : '' }}">
                <img src="{{asset('media/img/dashboard/sidebar/compass.svg')}}" alt="image" class="mr-15">
                Dashboard
            </a>
        </div>

        <div class="sidebar__item">
            <a href="{{route('dashboard.studio.booking')}}"
               class="sidebar__button d-flex items-center text-15 lh-1 fw-500 {{ request()->routeIs('dashboard.studio.booking') ? '-is-active' : '' }}">
                <img src="{{asset('media/img/dashboard/sidebar/booking.svg')}}" alt="image" class="mr-15">
                Réservations
            </a>
        </div>

        <div class="sidebar__item">
            <div class="accordion -db-sidebar js-accordion">
                <div class="accordion__item">
                    <div class="accordion__button">
                        <div class="sidebar__button col-12 d-flex items-center justify-between {{ request()->routeIs('dashboard.studio.myStudios', 'dashboard.studio.create', 'dashboard.studio.edit') ? '-is-active' : '' }}">
                            <div class="d-flex items-center text-15 lh-1 fw-500">
                                <img src="{{asset('media/img/dashboard/sidebar/hotel.svg')}}" alt="image" class="mr-10">
                                Gestion Studio
                            </div>
                            <div class="icon-chevron-sm-down text-7"></div>
                        </div>
                    </div>

                    <div class="accordion__content">
                        <ul class="list-disc pt-15 pb-5 pl-40">
                            <li>
                                <a href="{{route('dashboard.studio.myStudios')}}"
                                   class="text-15 {{ request()->routeIs('dashboard.studio.myStudios') ? 'text-blue-500 font-bold' : '' }}">
                                    Tous mes studios
                                </a>
                            </li>

                            <li>
                                <a href="{{route('dashboard.studio.create')}}"
                                   class="text-15 {{ request()->routeIs('dashboard.studio.create') ? 'text-blue-500 font-bold' : '' }}">
                                    Ajouter un studio
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button">
                <a href="{{route('dashboard.settings')}}"
                   class="d-flex items-center text-15 lh-1 fw-500 {{ request()->routeIs(['dashboard.settings', 'dashboard.studio.settings']) ? '-is-active' : '' }}">
                    <img src="{{asset('media/img/dashboard/sidebar/gear.svg')}}" alt="image" class="mr-15">
                    Paramètres
                </a>
            </div>
        </div>

        <div class="sidebar__item mt-20 pt-20" style="border-top: 1px solid #eee;">
            <div class="text-11 fw-500 text-light-1 uppercase mb-10 pl-15">Navigation Site</div>
            <div class="sidebar__item">
                <a href="{{ url('/') }}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                    <i class="icon-home text-20 mr-15"></i>
                    Accueil
                </a>
            </div>
            <div class="sidebar__item">
                <a href="{{ route('studio_list') }}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
                    <i class="icon-search text-20 mr-15"></i>
                    Nos studios
                </a>
            </div>
            <div class="sidebar__item">
                <a href="{{ route('about') }}" class="sidebar__button d-flex items-center text-15 lh-1 fw-500">
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

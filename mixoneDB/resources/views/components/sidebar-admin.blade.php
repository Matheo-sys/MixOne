<div class="dashboard__sidebar bg-white scroll-bar-1">
    <div class="sidebar -dashboard">
        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('admin.dashboard') ? '-is-active' : '' }}">
                <a href="{{route('admin.dashboard')}}" class="d-flex items-center text-15 lh-1 fw-500 ">
                    Vue d'ensemble
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('admin.users.*') ? '-is-active' : '' }}">
                <a href="{{route('admin.users.index')}}" class="d-flex items-center text-15 lh-1 fw-500 ">
                    Utilisateurs
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('admin.studios.*') ? '-is-active' : '' }}">
                <a href="{{route('admin.studios.index')}}" class="d-flex items-center text-15 lh-1 fw-500">
                    Studios
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('admin.moderation.*') ? '-is-active' : '' }}">
                <a href="{{route('admin.moderation.index')}}" class="d-flex items-center justify-between text-15 lh-1 fw-500">
                    <span>Modération Images</span>
                    @php $pCount = \App\Models\StudioImageRequest::where('status', 'pending')->count(); @endphp
                    @if($pCount > 0)
                        <span class="size-20 flex-center bg-red-1 rounded-full text-10 text-white fw-600 ml-10" style="min-width: 20px;">{{ $pCount }}</span>
                    @endif
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('admin.reservations.*') ? '-is-active' : '' }}">
                <a href="{{route('admin.reservations.index')}}" class="d-flex items-center text-15 lh-1 fw-500">
                    Réservations
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('admin.disputes.*') ? '-is-active' : '' }}">
                <a href="{{route('admin.disputes.index')}}" class="d-flex items-center text-15 lh-1 fw-500">
                    Litiges
                </a>
            </div>
        </div>

        <div class="sidebar__item">
            <div class="sidebar__button {{ request()->routeIs('admin.payouts.*') ? '-is-active' : '' }}">
                <a href="{{route('admin.payouts.index')}}" class="d-flex items-center text-15 lh-1 fw-500">
                    Virements
                </a>
            </div>
        </div>
        <div class="sidebar__item mt-20 border-top-light pt-20">
            <div class="text-12 fw-500 text-light-1 mb-10 px-20">MES DASHBOARDS</div>
            
            <div class="sidebar__button">
                <a href="{{ route('dashboard.artist.index') }}" class="d-flex items-center text-15 lh-1 fw-500">
                    <i class="icon-customer text-16 mr-10"></i> Dashboard Artiste
                </a>
            </div>

            <div class="sidebar__button">
                <a href="{{ route('dashboard.studio') }}" class="d-flex items-center text-15 lh-1 fw-500">
                    <i class="icon-home text-16 mr-10"></i> Dashboard Studio
                </a>
            </div>
        </div>
        <div class="sidebar__item mt-10 border-top-light pt-10">
            <a href="/"
               onclick="event.preventDefault();
                document.getElementById('logout-form').submit();"
               class="sidebar__button d-flex items-center text-15 lh-1 fw-500 text-red-1">
                Se Déconnecter
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>

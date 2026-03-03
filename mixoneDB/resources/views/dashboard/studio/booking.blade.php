@extends('layouts.backendDB')

@section('content')
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">
            <h1 class="text-30 lh-14 fw-600">Historique des réservations</h1>
            <div class="text-15 text-light-1">Consultez l'historique des réservations de votre studio.</div>
        </div>

        <div class="col-auto">
            <div class="row x-gap-20 y-gap-20 items-center">
                <div class="col-auto">
                    <div class="w-230 single-field relative d-flex items-center">
                        <input type="date" id="start" name="trip-start" value="2018-07-22" min="2018-01-01" max="2018-12-31" class="date-input bg-white text-dark-1 h-50 rounded-8 pl-45">
                        <button class="absolute d-flex items-center h-full pointer-events-none">
                            <i class="icon-calendar text-20 px-15 text-dark-1"></i>
                        </button>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="dropdown js-dropdown js-services-active">
                        <div class="dropdown__button d-flex items-center justify-between bg-white rounded-4 w-230 text-14 px-20 h-50 text-14" data-el-toggle=".js-services-toggle" data-el-toggle-active=".js-services-active">
                            <span class="js-dropdown-title">Services</span>
                            <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                        </div>

                        <div class="toggle-element -dropdown  js-click-dropdown js-services-toggle">
                            <div class="text-14 y-gap-15 js-dropdown-list">
                                <div><a href="#" class="d-block js-dropdown-link">Tous</a></div>
                                <div><a href="#" class="d-block js-dropdown-link">Enregistrements</a></div>
                                <div><a href="#" class="d-block js-dropdown-link">Production</a></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-auto">
                    <form action="{{ route('dashboard.studio.booking') }}" method="GET" class="d-flex items-center">
                        <div class="w-230 single-field relative d-flex items-center mr-10">
                            <input name="query" class="pl-50 bg-white text-dark-1 h-50 rounded-8" type="search" placeholder="Rechercher..." value="{{ $query ?? '' }}">
                            <button type="submit" class="absolute d-flex items-center h-full">
                                <i class="icon-search text-20 px-15 text-dark-1"></i>
                            </button>
                        </div>
                        <a href="{{ route('dashboard.studio.booking') }}" class="btn btn-outline-primary h-50 d-flex items-center justify-center rounded-8 px-15 hover:bg-blue-1 hover:text-white transition-all">
                            <i class="icon-refresh-cw text-20 text-blue-1 hover:text-white"></i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Toutes les réservations</button>
                </div>

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-2">Confirmées</button>
                </div>

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-3">En attente</button>
                </div>

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-4">Annulées</button>
                </div>
            </div>

            <div class="tabs__content pt-30 js-tabs-content">
                {{-- Tab 1 : Toutes --}}
                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <div class="overflow-scroll scroll-bar-1">
                        @if($reservations->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">
                                Aucun résultat ne correspond à votre recherche.
                            </div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $reservations])
                        @endif
                    </div>
                </div>

                {{-- Tab 2 : Confirmées --}}
                <div class="tabs__pane -tab-item-2">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $confirmed = $reservations->where('status', 'Confirmée'); @endphp
                        @if($confirmed->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation confirmée.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $confirmed])
                        @endif
                    </div>
                </div>

                {{-- Tab 3 : En attente --}}
                <div class="tabs__pane -tab-item-3">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $pending = $reservations->where('status', 'En attente'); @endphp
                        @if($pending->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation en attente.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $pending])
                        @endif
                    </div>
                </div>

                {{-- Tab 4 : Annulées --}}
                <div class="tabs__pane -tab-item-4">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $cancelled = $reservations->where('status', 'Annulée'); @endphp
                        @if($cancelled->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation annulée.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $cancelled])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

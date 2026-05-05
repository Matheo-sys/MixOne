@extends('layouts.backendDB')

@section('content')
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">
            <h1 class="text-30 lh-14 fw-600">Historique des réservations</h1>
            <div class="text-15 text-light-1">Consultez l'historique des réservations de votre studio.</div>
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

    <div class="row mb-30">
        <div class="col-12">
            <div class="px-20 py-20 rounded-4 bg-blue-1-05 border-light">
                <div class="d-flex items-center">
                    <i class="icon-info text-24 text-blue-1 mr-15"></i>
                    <div>
                        <h4 class="text-16 fw-500 text-blue-1">Vérification des sessions</h4>
                        <p class="text-14 text-dark-1 mt-5">
                            Lorsqu'un artiste paie, la session apparaît "En attente". Vous devez d'abord la <b>Confirmer</b>. 
                            Le jour de la session, demandez le <b>Code PIN à 4 chiffres</b> à l'artiste et entrez-le en cliquant sur "Terminer" pour débloquer votre paiement vers votre solde disponible.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Toutes</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-2">En attente</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-3">Confirmées</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-4">Refusées</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-5">Annulées</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-6">Terminées</button>
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

                {{-- Tab 2 : En attente --}}
                <div class="tabs__pane -tab-item-2">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $pending = $reservations->filter(fn($r) => $r->status === \App\Enums\ReservationStatus::Pending); @endphp
                        @if($pending->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation en attente.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $pending])
                        @endif
                    </div>
                </div>

                {{-- Tab 3 : Confirmées --}}
                <div class="tabs__pane -tab-item-3">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $confirmed = $reservations->filter(fn($r) => $r->status === \App\Enums\ReservationStatus::Confirmed); @endphp
                        @if($confirmed->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation confirmée.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $confirmed])
                        @endif
                    </div>
                </div>

                {{-- Tab 4 : Refusées --}}
                <div class="tabs__pane -tab-item-4">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $refused = $reservations->filter(fn($r) => $r->status === \App\Enums\ReservationStatus::Refused); @endphp
                        @if($refused->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation refusée.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $refused])
                        @endif
                    </div>
                </div>

                {{-- Tab 5 : Annulées --}}
                <div class="tabs__pane -tab-item-5">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $cancelled = $reservations->filter(fn($r) => $r->status === \App\Enums\ReservationStatus::Cancelled); @endphp
                        @if($cancelled->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation annulée.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $cancelled])
                        @endif
                    </div>
                </div>

                {{-- Tab 6 : Terminées --}}
                <div class="tabs__pane -tab-item-6">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $completed = $reservations->filter(fn($r) => $r->status === \App\Enums\ReservationStatus::Completed); @endphp
                        @if($completed->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation terminée.</div>
                        @else
                            @include('dashboard.studio.partials.reservations-table', ['rows' => $completed])
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

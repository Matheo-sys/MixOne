@extends('layouts.backendDB')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-30 fw-600">Historique des réservations</h1>
                </div>
                <div class="text-center mt-10">
                    <p>Consultez l'historique complet de vos réservations passées.</p>
                </div>
            </div>
        </div>
    </div>


    <div class="py-30 px-30 rounded-4 bg-white shadow-3 mt-90">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Toutes les réservation</button>
                </div>

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-2">Complètes</button>
                </div>

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-3">Confirmés</button>
                </div>

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-4">En cours de traitement</button>
                </div>

                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button " data-tab-target=".-tab-item-5">Annulés</button>
                </div>


            </div>

            <div class="tabs__content pt-30 js-tabs-content">

                {{-- Tab 1 : Toutes --}}
                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <div class="overflow-scroll scroll-bar-1">
                        @include('dashboard.artist.partials.reservations-table', ['rows' => $reservations])
                    </div>
                </div>

                {{-- Tab 2 : Complètes (Confirmées) --}}
                <div class="tabs__pane -tab-item-2">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $complete = $reservations->whereIn('status', ['Confirmée']); @endphp
                        @if($complete->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation complète.</div>
                        @else
                            @include('dashboard.artist.partials.reservations-table', ['rows' => $complete])
                        @endif
                    </div>
                </div>

                {{-- Tab 3 : Confirmés --}}
                <div class="tabs__pane -tab-item-3">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $confirmed = $reservations->where('status', 'Confirmée'); @endphp
                        @if($confirmed->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation confirmée.</div>
                        @else
                            @include('dashboard.artist.partials.reservations-table', ['rows' => $confirmed])
                        @endif
                    </div>
                </div>

                {{-- Tab 4 : En cours de traitement (En attente) --}}
                <div class="tabs__pane -tab-item-4">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $pending = $reservations->where('status', 'En attente'); @endphp
                        @if($pending->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation en attente.</div>
                        @else
                            @include('dashboard.artist.partials.reservations-table', ['rows' => $pending])
                        @endif
                    </div>
                </div>

                {{-- Tab 5 : Annulés --}}
                <div class="tabs__pane -tab-item-5">
                    <div class="overflow-scroll scroll-bar-1">
                        @php $cancelled = $reservations->where('status', 'Annulée'); @endphp
                        @if($cancelled->isEmpty())
                            <div class="text-center py-20 text-16 text-light-1">Aucune réservation annulée.</div>
                        @else
                            @include('dashboard.artist.partials.reservations-table', ['rows' => $cancelled])
                        @endif
                    </div>
                </div>

            </div>
        </div>

        <div class="pt-30">
            <div class="row justify-between">
                <div class="col-auto">
                    <button class="button -blue-1 size-40 rounded-full border-light">
                        <i class="icon-chevron-left text-12"></i>
                    </button>
                </div>

                <div class="col-auto">
                    <div class="row x-gap-20 y-gap-20 items-center">

                        <div class="col-auto">

                            <div class="size-40 flex-center rounded-full size-40 flex-center rounded-full bg-dark-1 text-white">1</div>

                        </div>

                        <div class="col-auto">

                            <div class="size-40 flex-center rounded-full bg-light-2">2</div>

                        </div>

                        <div class="col-auto">

                            <div class="size-40 flex-center rounded-full">3</div>

                        </div>

                        <div class="col-auto">

                            <div class="size-40 flex-center rounded-full">4</div>

                        </div>

                        <div class="col-auto">

                            <div class="size-40 flex-center rounded-full">5</div>

                        </div>

                        <div class="col-auto">

                            <div class="size-40 flex-center rounded-full">...</div>

                        </div>

                        <div class="col-auto">

                            <div class="size-40 flex-center rounded-full">20</div>

                        </div>

                    </div>
                </div>

                <div class="col-auto">
                    <button class="button -blue-1 size-40 rounded-full border-light">
                        <i class="icon-chevron-right text-12"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection

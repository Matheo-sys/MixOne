@extends('layouts.backendDB')

@section('content')
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">Historique des réservations</h1>
            <div class="text-15 text-light-1">Lorem ipsum dolor sit amet, consectetur.</div>

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
                    <div class="w-230 single-field relative d-flex items-center">
                        <input class="pl-50 bg-white text-dark-1 h-50 rounded-8" type="email" placeholder="Search">
                        <button class="absolute d-flex items-center h-full">
                            <i class="icon-search text-20 px-15 text-dark-1"></i>
                        </button>
                    </div>
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
                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <div class="overflow-scroll scroll-bar-1">
                        <table class="table-3 -border-bottom col-12">
                            <thead class="bg-light-2">
                            <tr>
                                <th>N°</th>
                                <th>Client</th>
                                <th>Date de réservation</th>
                                <th>Créneau Réservé</th>
                                <th>Heures</th>
                                <th>Total</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reservations as $reservation)
                                <tr>
                                    <td>{{ $reservation->id }}</td>
                                    <td>{{ $reservation->user_id->email }}</td>
                                    <td>{{ $reservation->created_at->format('d/m/Y') }}</td>
                                    <td class="lh-16">
                                        Début : {{ \Carbon\Carbon::parse($reservation->time_slot)->format('d/m/Y à H:i') }}<br>
                                        Fin : {{ \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours)->format('d/m/Y à H:i') }}
                                    </td>
                                    <td class="fw-500">{{ $reservation->number_of_hours }}h</td>
                                    <td>{{ number_format($reservation->total_price, 2) }}€</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'confirmé' => 'bg-green-4 text-green-3',
                                                'en attente' => 'bg-yellow-4 text-yellow-3',
                                                'annulé' => 'bg-red-4 text-red-3'
                                            ];
                                        @endphp
                                        <span class="rounded-100 py-4 px-10 text-center text-14 fw-500 {{ $statusClasses[$reservation->status] ?? 'bg-light-3' }}">
                                            {{ $reservation->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="dropdown js-dropdown">
                                            <div class="dropdown__button d-flex items-center rounded-4 text-blue-1 bg-blue-1-05 text-14 px-15 py-5"
                                                 data-el-toggle=".js-actions-{{ $reservation->id }}-toggle">
                                                <span class="js-dropdown-title">Actions</span>
                                                <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                                            </div>
                                            <div class="toggle-element -dropdown-2 js-actions-{{ $reservation->id }}-toggle">
                                                <div class="text-14 fw-500">
                                                    @if($reservation->status === 'en attente')
                                                        <form action="{{ route('studio.reservations.confirm', $reservation->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="d-block text-left px-15 py-5 hover:bg-blue-1-05 hover:text-blue-1">
                                                                Confirmer
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="#" class="d-block px-15 py-5 hover:bg-blue-1-05 hover:text-blue-1">
                                                        Facture
                                                    </a>
                                                    @if($reservation->status !== 'annulé')
                                                        <form action="{{ route('studio.reservations.cancel', $reservation->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="d-block text-left px-15 py-5 hover:bg-red-1-05 hover:text-red-1">
                                                                Annuler
                                                            </button>
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

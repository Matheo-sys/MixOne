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

                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <div class="overflow-scroll scroll-bar-1">
                        <table class="table-3 -border-bottom col-12">
                            <thead class="bg-light-2">
                            <tr>
                                <th>N°</th>
                                <th>Studio</th>
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
                                    <td>{{ $reservation->studio->name }}</td>
                                    <td>{{ $reservation->created_at->format('d/m/Y') }}</td>
                                    <td class="lh-16">
                                        Début : {{ \Carbon\Carbon::parse($reservation->time_slot)->format('d/m/Y à H:i') }}<br>
                                        Fin : {{ \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours)->format('d/m/Y à H:i') }}
                                    </td>
                                    <td class="fw-500">{{ $reservation->number_of_hours }}h</td>
                                    <td class="fw-500">{{ number_format($reservation->price, 2) }}€</td>
                                    <td>
                                        @php
                                            $statusClasses = [
                                                'Confirmée' => 'bg-green-4',
                                                'En attente' => 'bg-yellow-4',
                                                'Annulée' => 'bg-red-4',
                                                'En cours' => 'bg-blue-4'
                                            ];
                                        @endphp
                                        <span class="rounded-100 py-4 px-10 text-center text-14 fw-500 {{ $statusClasses[$reservation->status] ?? 'bg-light-3' }}">
                    {{ $reservation->status }}
                </span>
                                    </td>
                                    <td>
                                        <div class="dropdown js-dropdown js-actions-1-active">
                                            <div class="dropdown__button d-flex items-center rounded-4 text-blue-1 bg-blue-1-05 text-14 px-15 py-5"
                                                 data-el-toggle=".js-actions-{{ $reservation->id }}-toggle"
                                                 data-el-toggle-active=".js-actions-{{ $reservation->id }}-active">
                                                <span class="js-dropdown-title">Actions</span>
                                                <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                                            </div>

                                            <div class="toggle-element -dropdown-2 js-click-dropdown js-actions-{{ $reservation->id }}-toggle">
                                                <div class="text-14 fw-500 js-dropdown-list">
                                                    @if($reservation->status === 'En attente')
                                                        <form action="{{ route('reservations.confirm', $reservation->id) }}"
                                                              method="POST"
                                                              class="w-full">
                                                            @csrf
                                                            <button type="submit"
                                                                    class="d-block w-full text-left px-15 py-5 hover:bg-blue-1-05 hover:text-blue-1">
                                                                Confirmer
                                                            </button>
                                                        </form>
                                                    @endif

                                                    <a href="#"
                                                       class="d-block px-15 py-5 hover:bg-blue-1-05 hover:text-blue-1">
                                                        Facture
                                                    </a>

                                                    @if(in_array($reservation->status, ['En attente']))
                                                        <form action="{{ route('reservations.cancel', $reservation->id) }}"
                                                              method="POST"
                                                              class="w-full">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="d-block w-full text-left px-15 py-5 hover:bg-red-1-05 hover:text-red-1">
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

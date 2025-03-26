@extends('layouts.backendDB')

@section('content')
    <div class="row y-gap-20 justify-center items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto text-center">
            <h1 class="text-40 lh-14 fw-700 mb-10">Dashboard</h1>
            <div class="text-16 text-light-1">Suivez vos gains, votre argent en attente et l'activité récente de vos studios en un seul endroit.</div>
        </div>
    </div>
    <div class="row y-gap-30">
        <div class="col-xl-4 dashboard-stats-column">
            <div class="row y-gap-30">
                <div class="col-12 mb-10">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <div class="row y-gap-20 justify-between items-center">
                            <div class="col-auto">
                                <div class="fw-500 lh-14">En attente</div>
                                <div class="text-26 lh-16 fw-600 mt-5">
                                    @php
                                        $totalEnAttente = $reservations->where('status', 'En attente')->sum('price');
                                        echo number_format($totalEnAttente, 2, ',', ' ') . ' €';
                                    @endphp
                                </div>
                                <div class="text-15 lh-14 text-light-1 mt-5">Total en attente</div>
                            </div>

                            <div class="col-auto">
                                <img src="{{ asset('media/img/dashboard/icons/1.svg') }}" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mb-10">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <div class="row y-gap-20 justify-between items-center">
                            <div class="col-auto">
                                <div class="fw-500 lh-14">Gains</div>
                                <div class="text-26 lh-16 fw-600 mt-5">
                                    @php
                                        $totalGains = $reservations->whereIn('status', ['Confirmée'])->sum('price');
                                        echo number_format($totalGains, 2, ',', ' ') . ' €';
                                    @endphp
                                </div>
                                <div class="text-15 lh-14 text-light-1 mt-5">Total des gains</div>
                            </div>

                            <div class="col-auto">
                                <img src="{{ asset('media/img/dashboard/icons/2.svg') }}" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <div class="row y-gap-20 justify-between items-center">
                            <div class="col-auto">
                                <div class="fw-500 lh-14">Réservations</div>
                                <div class="text-26 lh-16 fw-600 mt-5">
                                    {{ $reservations->count() }}
                                </div>
                                <div class="text-15 lh-14 text-light-1 mt-5">Total des réservations</div>
                            </div>

                            <div class="col-auto">
                                <img src="{{ asset('media/img/dashboard/icons/3.svg') }}" alt="icon">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="d-flex justify-between items-center mb-5">
                    <h2 class="text-18 lh-1 fw-500">
                        Réservations Récentes
                    </h2>

                    <div class="">
                        <a href="{{ route('dashboard.studio.booking') }}" class="text-14 text-blue-1 fw-500 underline">Voir Tout</a>
                    </div>
                </div>

                <div class="overflow-x-auto scroll-bar-1">
                    <table class="table-2 col-12">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Montant Total</th>
                            <th>Payé</th>
                            <th>Statut</th>
                            <th>Créé le</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reservations->sortByDesc('created_at')->take(6) as $index => $reservation)
                            <tr>
                                <td>N°{{ $reservation->id }}</td>
                                <td>{{ $reservation->user->email }}</td>
                                <td class="fw-500">{{ number_format($reservation->price, 2) }}€</td>
                                <td>{{ number_format($reservation->price, 2) }}€</td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'Confirmée' => 'bg-blue-1-05',
                                            'En attente' => 'bg-yellow-4',
                                            'Annulée' => 'text-red-1',
                                            'En cours' => 'bg-blue-4'
                                        ];
                                    @endphp
                                    <div class="rounded-100 py-4 text-center col-12 text-14 fw-500 {{ $statusClasses[$reservation->status] ?? 'bg-gray-3 text-gray-2' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </div>
                                </td>
                                <td>{{ $reservation->created_at->format('d/m/Y') }}<br>{{ $reservation->created_at->format('H:i') }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    @if($reservations->isEmpty())
                        <p class="text-center text-gray-600 mt-20">Aucune réservation récente.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!--<div class="row y-gap-30 pt-20">
        <div class="col-xl-7 col-md-6">
            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="d-flex justify-between items-center">
                    <h2 class="text-18 lh-1 fw-500">
                        Statistiques des Gains
                    </h2>

                    <div class="dropdown js-dropdown js-category-active">
                        <div class="dropdown__button d-flex items-center bg-white border-light rounded-100 px-15 py-10 text-14 lh-12"
                             data-el-toggle=".js-category-toggle"
                             data-el-toggle-active=".js-category-active">
                            <span class="js-dropdown-title">Cette semaine</span>
                            <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                        </div>

                        <div class="toggle-element -dropdown js-click-dropdown js-category-toggle">
                            <div class="text-14 y-gap-15 js-dropdown-list">
                                <div><a href="#" class="d-block js-dropdown-link">Tous</a></div>
                                <div><a href="#" class="d-block js-dropdown-link">Enregistrement</a></div>
                                <div><a href="#" class="d-block js-dropdown-link">Production</a></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="pt-30">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
        </div>
    </div>-->
@endsection

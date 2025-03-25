@extends('layouts.backendDB')

@section('content')
    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">

            <h1 class="text-30 lh-14 fw-600">Dashboard</h1>
            <div class="text-15 text-light-1">Lorem ipsum dolor sit amet, consectetur.</div>

        </div>

        <div class="col-auto">

        </div>
    </div>


    <div class="row y-gap-30">

        <div class="col-xl-3 col-md-6">
            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="row y-gap-20 justify-between items-center">
                    <div class="col-auto">
                        <div class="fw-500 lh-14">En attente</div>
                        <div class="text-26 lh-16 fw-600 mt-5">
                            @php
                                $totalEnAttente = $reservations->where('status', 'en attente')->sum('price');
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

        <div class="col-xl-3 col-md-6">
            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="row y-gap-20 justify-between items-center">
                    <div class="col-auto">
                        <div class="fw-500 lh-14">Gains</div>
                        <div class="text-26 lh-16 fw-600 mt-5">
                            @php
                                $totalGains = $reservations->whereIn('status', ['confirmé', 'completé'])->sum('price');
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

        <div class="col-xl-3 col-md-6">
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

    <div class="row y-gap-30 pt-20">



        <div class="col-xl-5 col-md-6">
            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="d-flex justify-between items-center">
                    <h2 class="text-18 lh-1 fw-500">
                        Réservations Récentes
                    </h2>

                    <div class="">
                        <a href="{{ route('dashboard.studio.booking') }}" class="text-14 text-blue-1 fw-500 underline">Voir Tout</a>
                    </div>
                </div>

                <div class="overflow-scroll scroll-bar-1 pt-30">
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
                        @foreach($reservations as $index => $reservation)
                            <tr>
                                <td>#{{ $index + 1 }}</td>
                                <td>{{ $reservation->user->email }}</td>
                                <td class="fw-500">${{ number_format($reservation->total_amount, 2) }}</td>
                                <td>${{ number_format($reservation->amount_paid, 2) }}</td>
                                <td>
                                    @php
                                        $statusClasses = [
                                            'En attente' => 'bg-yellow-4 text-yellow-3',
                                            'Confirmée' => 'bg-blue-1-05 text-blue-1',
                                            'Rejetée' => 'bg-red-3 text-red-2'
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
@endsection

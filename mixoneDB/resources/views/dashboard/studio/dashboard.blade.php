@extends('layouts.backendDB')

@section('content')
    <div class="row y-gap-20 justify-center items-end pb-40 lg:pb-30 md:pb-24">
        <div class="col-auto text-center">
            <h1 class="text-30 sm:text-26 lh-14 fw-700 mb-10">Dashboard</h1>
            <div class="text-16 text-light-1">Suivez l'activité de vos studios en un clin d'œil.</div>
        </div>
    </div>
    <div class="row y-gap-30">
        <div class="col-xl-4 col-md-6">
            <div class="py-30 px-30 sm:px-20 rounded-4 bg-white shadow-3 h-full">
                <div class="row y-gap-20 justify-between items-center">
                    <div class="col-auto">
                        <div class="fw-500 lh-14 text-light-1">En attente</div>
                        <div class="text-26 lh-16 fw-600 mt-5">
                            {{ number_format($totalPending ?? 0, 2, ',', ' ') }} €
                        </div>
                        <div class="text-15 lh-14 text-light-1 mt-5">Total en attente</div>
                    </div>

                    <div class="col-auto">
                        <img src="{{ asset('media/img/dashboard/icons/1.svg') }}" alt="icon">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="py-30 px-30 sm:px-20 rounded-4 bg-white shadow-3 h-full">
                <div class="row y-gap-20 justify-between items-center">
                    <div class="col-auto">
                        <div class="fw-500 lh-14 text-light-1">Gains (Solde Dispo)</div>
                        <div class="text-26 lh-16 fw-600 mt-5">
                            {{ number_format($wallet->balance ?? 0, 2, ',', ' ') }} €
                        </div>
                        <div class="text-15 lh-14 text-light-1 mt-5">Gains retirables</div>
                    </div>

                    <div class="col-auto">
                        <img src="{{ asset('media/img/dashboard/icons/2.svg') }}" alt="icon">
                    </div>
                </div>
                <div class="mt-20">
                    <form action="{{ route('wallet.recharge') }}" method="POST">
                        @csrf
                        <button type="submit" class="button -md -blue-1 bg-blue-1-05 text-blue-1 w-1/1">Récupérer mes gains</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6">
            <div class="py-30 px-30 sm:px-20 rounded-4 bg-white shadow-3 h-full">
                <div class="row y-gap-20 justify-between items-center">
                    <div class="col-auto">
                        <div class="fw-500 lh-14 text-light-1">Réservations</div>
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

    <div class="row y-gap-30 pt-30">
        {{-- Liste des réservations - Masquée sur mobile (max-width 767px) --}}
        <div class="col-xl-8 md:d-none">
            <div class="py-30 px-30 sm:px-15 rounded-4 bg-white shadow-3 h-full">
                <div class="d-flex justify-between items-center mb-15">
                    <h2 class="text-18 lh-1 fw-500">
                        Réservations Récentes
                    </h2>

                    <div class="">
                        <a href="{{ route('dashboard.studio.booking') }}" class="text-14 text-blue-1 fw-500 underline">Voir Tout</a>
                    </div>
                </div>

                <div class="overflow-x-auto scroll-bar-1">
                    <table class="table-2 col-12 table-responsive-cards">
                        <thead>
                        <tr>
                            <th>N°</th>
                            <th>Client</th>
                            <th>Montant Total</th>
                            <th>Payé</th>
                            <th>Statut</th>
                            <th>Créé le</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reservations->sortByDesc('created_at')->take(6) as $index => $reservation)
                            <tr>
                                <td data-label="N°">N°{{ $reservation->id }}</td>
                                <td data-label="Client">{{ $reservation->user->email }}</td>
                                <td data-label="Total" class="fw-500">{{ number_format($reservation->price, 2) }}€</td>
                                <td data-label="Payé">{{ $reservation->status === 'Confirmée' ? number_format($reservation->price, 2).'€' : '0,00€' }}</td>
                                <td data-label="Statut">
                                    @php
                                        $statusClasses = [
                                            'confirmée' => 'bg-green-1 text-green-2',
                                            'en attente' => 'bg-yellow-4 text-dark-1',
                                            'annulée' => 'bg-red-3 text-red-2',
                                            'refusée' => 'bg-red-3 text-red-2',
                                            'terminée' => 'bg-blue-1-05 text-blue-1',
                                        ];
                                        $lowStatus = strtolower($reservation->status);
                                    @endphp
                                    <div class="rounded-100 py-4 text-center col-12 sm:col-auto px-15 text-13 fw-500 {{ $statusClasses[$lowStatus] ?? 'bg-gray-3 text-gray-2' }}">
                                        {{ ucfirst($reservation->status) }}
                                    </div>
                                </td>
                                <td data-label="Date" class="text-right sm:text-left">{{ $reservation->created_at->format('d/m/Y') }} à {{ $reservation->created_at->format('H:i') }}</td>
                                <td data-label="Action">
                                    @php $s = \Illuminate\Support\Str::lower($reservation->status); @endphp
                                    @if($s === 'en attente')
                                        {{-- En attente → Le studio peut Confirmer ou Refuser via des boutons --}}
                                        <div class="d-flex x-gap-10 y-gap-5 flex-wrap">
                                            <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="button -sm bg-blue-1 text-white px-10 py-5 rounded-4 text-13 fw-500">Confirmer</button>
                                            </form>
                                            <form action="{{ route('reservations.refuse', $reservation->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="button -sm bg-red-2 text-white px-10 py-5 rounded-4 text-13 fw-500">Refuser</button>
                                            </form>
                                        </div>
                                    @elseif($s === 'confirmée')
                                        <div class="d-flex x-gap-10 y-gap-5 flex-wrap">
                                            <form action="{{ route('reservations.complete', $reservation->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="button -sm bg-green-1 text-green-2 px-10 py-5 rounded-4 text-13 fw-500" title="Marquer comme payée / effectuée">Terminer</button>
                                            </form>
                                        </div>
                                    @else
                                        <span class="text-light-1 text-13">—</span>
                                    @endif
                                </td>
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

        <div class="col-xl-4 col-md-12">
            <div class="py-30 px-30 rounded-4 bg-white shadow-3 h-full">
                <div class="d-flex justify-between items-center">
                    <h2 class="text-18 lh-1 fw-500">
                        Statistiques des Gains
                    </h2>
                </div>

                <div class="pt-30" style="height: 350px; position: relative;">
                    <canvas id="studioLineChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('studioLineChart');
    if (ctx) {
        const chartDataRaw = {!! json_encode($chartData ?? []) !!};
        const labels = Object.keys(chartDataRaw);
        const data = Object.values(chartDataRaw);

        const finalLabels = labels.length ? labels : ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Juin'];
        const finalData = data.length ? data : [0, 0, 0, 0, 0, 0];

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: finalLabels,
                datasets: [{
                    label: 'Gains (€)',
                    data: finalData,
                    borderColor: '#1E2ED6',
                    backgroundColor: 'rgba(30, 46, 214, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e5e5', borderDash: [5, 5] }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }
});
</script>
@endpush

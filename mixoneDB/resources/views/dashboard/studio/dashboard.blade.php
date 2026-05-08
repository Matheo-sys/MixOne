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
                            {{ number_format($portefeuille->balance ?? 0, 2, ',', ' ') }} €
                        </div>
                        <div class="text-15 lh-14 text-light-1 mt-5">Gains retirables</div>
                    </div>

                    <div class="col-auto">
                        <img src="{{ asset('media/img/dashboard/icons/2.svg') }}" alt="icon">
                    </div>
                </div>
                <div class="mt-20">
                    <form action="{{ route('wallet.payout') }}" method="POST" class="d-flex flex-column y-gap-10">
                        @csrf
                        <div class="single-field relative d-flex items-center">
                            <input class="pl-15 bg-white text-dark-1 h-40 rounded-8 w-1/1 border-light" type="number" name="amount" placeholder="Montant (€)" required min="10" max="{{ $portefeuille->balance ?? 0 }}" step="0.01">
                        </div>
                        <div class="single-field relative d-flex items-center">
                            <input class="pl-15 bg-white text-dark-1 h-40 rounded-8 w-1/1 border-light" type="text" name="iban" placeholder="Votre IBAN" required minlength="15" value="{{ old('iban', auth()->user()->iban) }}">
                        </div>
                        @if(!auth()->user()->iban)
                            <div class="text-11 text-red-1">⚠️ Aucun IBAN enregistré. <a href="{{ route('dashboard.settings') }}" class="underline">Configurez-le ici</a>.</div>
                        @endif
                        <button type="submit" class="button -md -blue-1 bg-blue-1-05 text-blue-1 w-1/1 mt-5" {{ ($portefeuille->balance ?? 0) < 10 ? 'disabled' : '' }}>Demander un virement</button>
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
                                        $statusVal = $reservation->status instanceof \App\Enums\ReservationStatus ? $reservation->status->value : (string)$reservation->status;
                                        $lowStatus = strtolower($statusVal);
                                    @endphp
                                    <div class="rounded-100 py-4 text-center col-12 sm:col-auto px-15 text-13 fw-500 {{ $statusClasses[$lowStatus] ?? 'bg-gray-3 text-gray-2' }}">
                                        {{ ucfirst($lowStatus) }}
                                    </div>
                                </td>
                                <td data-label="Date" class="text-right sm:text-left">{{ $reservation->created_at->format('d/m/Y') }} à {{ $reservation->created_at->format('H:i') }}</td>
                                <td data-label="Action">
                                    @php $s = $lowStatus; @endphp
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
                    <canvas id="studioLineChart" data-chart="{{ json_encode($chartData ?? []) }}"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard/studio/dashboard.js') }}"></script>
@endpush

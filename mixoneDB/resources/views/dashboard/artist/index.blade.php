@extends('layouts.backendDB')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-40 lg:pb-30 md:pb-24">
    <div class="col-auto">
        <h1 class="text-30 sm:text-26 lh-14 fw-600">Tableau de Bord Artiste</h1>
        <div class="text-15 text-light-1">Gérez vos réservations, votre porte-monnaie et vos paiements.</div>
    </div>
</div>

<div class="row y-gap-30">
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3 h-full">
            <div class="row y-gap-20 justify-between items-center">
                <div class="col-auto">
                    <div class="fw-500 lh-14">Solde Disponible</div>
                    <div class="text-26 lh-16 fw-600 mt-5">{{ number_format($wallet->balance ?? 0, 2, ',', ' ') }} €</div>
                    <div class="text-15 lh-14 text-light-1 mt-5">Votre porte-monnaie</div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('media/img/dashboard/icons/1.svg') }}" alt="icon">
                </div>
            </div>
            <div class="mt-20">
                <form action="{{ route('wallet.recharge') }}" method="POST">
                    @csrf
                    <button type="submit" class="button -md -blue-1 bg-blue-1-05 text-blue-1 w-1/1">Recharger le compte (test 100€)</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center">
                <div class="col-auto">
                    <div class="fw-500 lh-14">Fonds en Attente</div>
                    <div class="text-26 lh-16 fw-600 mt-5">{{ number_format($wallet->pending_balance ?? 0, 2, ',', ' ') }} €</div>
                    <div class="text-15 lh-14 text-light-1 mt-5">Bloqué pour réservations</div>
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
                    <div class="fw-500 lh-14">Dépenses Totales</div>
                    <div class="text-26 lh-16 fw-600 mt-5">{{ number_format($totalSpent ?? 0, 2, ',', ' ') }} €</div>
                    <div class="text-15 lh-14 text-light-1 mt-5">Sessions terminées</div>
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
                    <div class="text-26 lh-16 fw-600 mt-5">{{ $reservations->count() }}</div>
                    <div class="text-15 lh-14 text-light-1 mt-5">Actives & Passées</div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('media/img/dashboard/icons/3.svg') }}" alt="icon">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row y-gap-30 pt-30">
    <div class="col-12">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3 h-full">
            <div class="d-flex justify-between items-center mb-20">
                <h2 class="text-18 lh-1 fw-500">Réservations Récentes</h2>
                <a href="{{ route('dashboard.artist.booking') }}" class="text-14 text-blue-1 underline">Voir tout l'historique</a>
            </div>
            
            <div class="overflow-x-auto scroll-bar-1">
                <table class="table-3 -border-bottom col-12">
                    <thead class="bg-light-2">
                        <tr>
                            <th>Studio</th>
                            <th>Date</th>
                            <th>Prix</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservations->take(5) as $res)
                        <tr>
                            <td>{{ $res->studio->name ?? 'Studio Inconnu' }}</td>
                            <td>{{ \Carbon\Carbon::parse($res->date)->format('d/m/Y') }}</td>
                            <td class="fw-500">{{ number_format($res->price, 2) }}€</td>
                            <td>
                                @php
                                    $statusClasses = [
                                        'Confirmée' => 'bg-green-1 text-green-2',
                                        'En attente' => 'bg-yellow-4 text-dark-1',
                                        'Annulée' => 'bg-red-3 text-red-2',
                                        'Terminée' => 'bg-blue-1-05 text-blue-1'
                                    ];
                                @endphp
                                <span class="rounded-100 py-4 px-10 text-center text-13 fw-500 {{ $statusClasses[$res->status] ?? 'bg-light-2' }}">
                                    {{ ucfirst($res->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-light-1 py-15">Aucune réservation trouvée.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

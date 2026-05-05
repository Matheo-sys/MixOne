@extends('layouts.admin')

@section('title', 'Toutes les Réservations')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Réservations</h1>
        <div class="text-15 text-light-1">Suivi de toutes les sessions sur MixOne.</div>
    </div>
</div>

<div class="py-30 px-30 rounded-4 bg-white shadow-3">
    <div class="overflow-scroll scroll-bar-1">
        <table class="table-3 -border-bottom col-12">
            <thead class="bg-light-2">
                <tr>
                    <th>ID</th>
                    <th>Artiste</th>
                    <th>Studio</th>
                    <th>Date Prévue</th>
                    <th>Heures</th>
                    <th>Montant Total</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservations as $reservation)
                <tr>
                    <td>#{{ $reservation->id }}</td>
                    <td class="fw-500">{{ $reservation->user->first_name ?? 'Inconnu' }}</td>
                    <td class="fw-500 text-blue-1">{{ $reservation->studio->name ?? 'Inconnu' }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->time_slot)->format('d/m/Y H:i') }}</td>
                    <td>{{ $reservation->number_of_hours }}h</td>
                    <td>{{ number_format($reservation->price, 2) }} €</td>
                    <td>
                        @if($reservation->status->value === 'En attente')
                            <span class="badge bg-yellow-4 text-yellow-3">{{ $reservation->status->value }}</span>
                        @elseif($reservation->status->value === 'Confirmée')
                            <span class="badge bg-blue-1-05 text-blue-1">{{ $reservation->status->value }}</span>
                        @elseif($reservation->status->value === 'Terminée')
                            <span class="badge bg-green-1-05 text-green-1">{{ $reservation->status->value }}</span>
                        @elseif($reservation->status->value === 'Litige')
                            <span class="badge bg-red-1-05 text-red-1">{{ $reservation->status->value }}</span>
                        @else
                            <span class="badge bg-light-2 text-dark-1">{{ $reservation->status->value }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-20 text-light-1">Aucune réservation trouvée.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-20">
        {{ $reservations->links() }}
    </div>
</div>
@endsection

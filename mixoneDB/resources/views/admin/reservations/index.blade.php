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
                    <td class="fw-500">
                        @if($reservation->client)
                            {{ $reservation->client->first_name }} {{ $reservation->client->last_name }}
                        @else
                            <span class="text-red-1">Inconnu</span>
                        @endif
                    </td>
                    <td class="fw-500 text-blue-1">
                        @if($reservation->studio)
                            {{ $reservation->studio->name }}
                        @else
                            <span class="text-red-1">Studio supprimé</span>
                        @endif
                    </td>
                    <td>
                        <div class="text-14 fw-500">{{ $reservation->date ? $reservation->date->format('d/m/Y') : 'N/A' }}</div>
                        <div class="text-12 text-light-1">{{ $reservation->time_slot }}</div>
                    </td>
                    <td>{{ $reservation->number_of_hours }}h</td>
                    <td class="fw-600">{{ number_format($reservation->price, 2) }} €</td>
                    <td>
                        @php
                            $status = $reservation->status->value;
                            $badgeClass = match($status) {
                                'En attente' => 'bg-yellow-4 text-yellow-3',
                                'Confirmée' => 'bg-blue-1-05 text-blue-1',
                                'Terminée' => 'bg-green-1-05 text-green-1',
                                'Litige' => 'bg-red-1-05 text-red-1',
                                'Annulée', 'Refusée' => 'bg-light-2 text-light-1',
                                default => 'bg-light-2 text-dark-1',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} px-10 py-5 rounded-4 text-12">{{ $status }}</span>
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

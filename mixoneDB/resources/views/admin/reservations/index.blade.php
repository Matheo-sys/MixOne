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
    
    {{-- Barre de filtres --}}
    <div class="row y-gap-20 items-center justify-between pb-30">
        <div class="col-12">
            <form action="{{ route('admin.reservations.index') }}" method="GET" class="row y-gap-20 items-end">
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Recherche</div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ID, Artiste, Studio..." class="border-light rounded-4 px-15 py-10">
                </div>
                
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Statut</div>
                    <select name="status" class="form-select border-light rounded-4 px-15 py-10">
                        <option value="">Tous les statuts</option>
                        @foreach(\App\Enums\ReservationStatus::cases() as $status)
                            <option value="{{ $status->value }}" {{ request('status') === $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="col-auto">
                    <button type="submit" class="button -md bg-blue-1 text-white px-20">Filtrer</button>
                </div>
                
                @if(request()->anyFilled(['search', 'status']))
                <div class="col-auto">
                    <a href="{{ route('admin.reservations.index') }}" class="button -md bg-light-2 text-dark-1 px-20">Réinitialiser</a>
                </div>
                @endif
            </form>
        </div>
    </div>

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
                    <td>
                        @if($reservation->client)
                            <div class="fw-500">{{ $reservation->client->first_name }} {{ $reservation->client->last_name }}</div>
                            <div class="text-13 text-light-1">{{ '@' . $reservation->client->username }}</div>
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
                            $status = $reservation->status;
                            $badgeClass = match($status) {
                                \App\Enums\ReservationStatus::Pending   => 'bg-yellow-4 text-yellow-3',
                                \App\Enums\ReservationStatus::Confirmed => 'bg-blue-1-05 text-blue-1',
                                \App\Enums\ReservationStatus::Completed => 'bg-green-1-05 text-green-1',
                                \App\Enums\ReservationStatus::Disputed  => 'bg-red-1-05 text-red-1',
                                \App\Enums\ReservationStatus::Cancelled, \App\Enums\ReservationStatus::Refused => 'bg-light-2 text-light-1',
                                default => 'bg-light-2 text-dark-1',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} px-10 py-5 rounded-4 text-12">{{ $status->label() }}</span>
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

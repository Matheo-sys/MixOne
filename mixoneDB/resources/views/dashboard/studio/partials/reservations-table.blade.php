<table class="table-3 -border-bottom col-12 table-responsive-cards">
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
    @foreach($rows as $reservation)
        <tr>
            <td data-label="N°">{{ $reservation->id }}</td>
            <td data-label="Client">{{ $reservation->user->first_name ?? '' }} {{ $reservation->user->last_name ?? $reservation->user->email }}</td>
            <td data-label="Date">{{ $reservation->created_at->format('d/m/Y') }}</td>
            <td data-label="Créneau" class="lh-16 text-right sm:text-left">
                {{ \Carbon\Carbon::parse($reservation->time_slot)->format('d/m/Y') }}<br>
                {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours)->format('H:i') }}
            </td>
            <td data-label="Heures" class="fw-500">{{ $reservation->number_of_hours }}h</td>
            <td data-label="Total" class="fw-500">{{ number_format($reservation->price, 2) }}€</td>
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
                <span class="rounded-100 py-4 px-10 text-center text-13 fw-500 {{ $statusClasses[$lowStatus] ?? 'bg-light-3' }}">
                    {{ ucfirst($reservation->status) }}
                </span>
            </td>
            <td data-label="Action">
                @php $s = \Illuminate\Support\Str::lower($reservation->status); @endphp
                @if($s === 'en attente')
                    {{-- En attente → Le studio peut Confirmer ou Refuser via des boutons --}}
                    <div class="d-flex x-gap-10 y-gap-5 flex-wrap">
                        <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button -sm bg-blue-1 text-white px-15 py-5 rounded-4 text-13 fw-500">
                                Confirmer
                            </button>
                        </form>
                        <form action="{{ route('reservations.refuse', $reservation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button -sm bg-red-2 text-white px-15 py-5 rounded-4 text-13 fw-500">
                                Refuser
                            </button>
                        </form>
                    </div>
                @elseif($s === 'confirmée')
                    {{-- Confirmée → Le studio peut Terminer --}}
                    <div class="d-flex x-gap-10 y-gap-5 flex-wrap">
                        <form action="{{ route('reservations.complete', $reservation->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="button -sm bg-green-1 text-green-2 px-15 py-5 rounded-4 text-13 fw-500" title="Marquer comme payée / effectuée">
                                Terminer
                            </button>
                        </form>
                    </div>
                @else
                    {{-- Annulée / Refusée / Terminée → Aucune action possible --}}
                    <span class="text-light-1 text-13">—</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

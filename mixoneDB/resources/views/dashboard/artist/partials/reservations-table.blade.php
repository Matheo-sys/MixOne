<table class="table-3 -border-bottom col-12 table-responsive-cards">
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
    @foreach($rows as $reservation)
        <tr>
            <td data-label="N°">{{ $reservation->id }}</td>
            <td data-label="Studio">{{ $reservation->studio->name ?? '—' }}</td>
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
                @php $s = strtolower($reservation->status); @endphp
                @if($s === 'en attente')
                    {{-- En attente → L'artiste peut Annuler sa demande --}}
                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button -sm bg-light-2 text-red-1 px-15 py-5 rounded-4 text-13 fw-500">
                            Annuler
                        </button>
                    </form>
                @else
                    {{-- Confirmée / Annulée / Refusée / Terminée → Aucune action --}}
                    <span class="text-light-1 text-13">—</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table-3 -border-bottom col-12">
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
            <td>{{ $reservation->id }}</td>
            <td>{{ $reservation->user->email ?? '—' }}</td>
            <td>{{ $reservation->created_at->format('d/m/Y') }}</td>
            <td class="lh-16">
                Début : {{ \Carbon\Carbon::parse($reservation->time_slot)->format('d/m/Y à H:i') }}<br>
                Fin : {{ \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours)->format('d/m/Y à H:i') }}
            </td>
            <td class="fw-500">{{ $reservation->number_of_hours }}h</td>
            <td>{{ number_format($reservation->price, 2) }}€</td>
            <td>
                @php
                    $statusClasses = [
                        'Confirmée' => 'bg-blue-1-05',
                        'En attente' => 'bg-yellow-4',
                        'Annulée' => 'text-red-1',
                    ];
                @endphp
                <span class="rounded-100 py-4 px-10 text-center text-14 fw-500 {{ $statusClasses[$reservation->status] ?? 'bg-light-3' }}">
                    {{ $reservation->status }}
                </span>
            </td>
            <td>
                <div class="dropdown js-dropdown">
                    <div class="dropdown__button d-flex items-center rounded-4 text-blue-1 bg-blue-1-05 text-14 px-15 py-5"
                         data-el-toggle=".js-actions-{{ $reservation->id }}-toggle">
                        <span class="js-dropdown-title">Actions</span>
                        <i class="icon icon-chevron-sm-down text-7 ml-10"></i>
                    </div>
                    <div class="toggle-element -dropdown-2 js-actions-{{ $reservation->id }}-toggle">
                        <div class="text-14 fw-500">
                            @if($reservation->status === 'En attente')
                                <form action="{{ route('reservations.confirm', $reservation->id) }}" method="POST" class="js-ajax-form">
                                    @csrf
                                    <button type="submit" class="d-block text-left px-15 py-5 hover:bg-blue-1-05 hover:text-blue-1">
                                        Confirmer
                                    </button>
                                </form>
                            @endif
                            <a href="#" class="d-block px-15 py-5 hover:bg-blue-1-05 hover:text-blue-1">
                                Facture
                            </a>
                            @if($reservation->status !== 'Annulée')
                                <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="js-ajax-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="d-block text-left px-15 py-5 hover:bg-red-1-05 hover:text-red-1">
                                        Annuler
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

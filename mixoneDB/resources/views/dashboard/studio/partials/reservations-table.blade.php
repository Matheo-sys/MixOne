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
                    $currentStatus = $reservation->status;
                    $statusValue = $currentStatus instanceof \App\Enums\ReservationStatus ? $currentStatus->value : (string)$currentStatus;
                    $lowStatus = strtolower($statusValue);
                    $paymentStatus = $reservation->payment_status ?? 'pending';
                @endphp
                <span class="rounded-100 py-4 px-10 text-center text-13 fw-500 {{ $statusClasses[$lowStatus] ?? 'bg-light-3' }}">
                    {{ ucfirst($lowStatus) }}
                </span>
                @if($paymentStatus === 'paid')
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-green-1 text-green-2 mt-5 d-inline-block">💳 Payé</span>
                @elseif($paymentStatus === 'refunded')
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-blue-1-05 text-blue-1 mt-5 d-inline-block">💳 Remboursé</span>
                @endif
            </td>
            <td data-label="Action">
                @php $s = $lowStatus; @endphp
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
                    {{-- Confirmée → Le studio peut Terminer ou Signaler un litige --}}
                    <div class="d-flex x-gap-10 y-gap-5 flex-wrap flex-column">
                        <button type="button" class="button -sm bg-green-1 text-green-2 px-15 py-5 rounded-4 text-13 fw-500 w-1/1" title="Marquer comme payée / effectuée" data-x-click="modal-pin-{{ $reservation->id }}">
                            Terminer (Code PIN)
                        </button>
                        
                        <form action="{{ route('reservations.dispute', $reservation->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir signaler un problème ? Les fonds seront bloqués.');">
                            @csrf
                            <button type="submit" class="button -sm bg-red-1 text-white px-15 py-5 rounded-4 text-13 fw-500 w-1/1">
                                Signaler un litige
                            </button>
                        </form>
                    </div>

                    {{-- Modal Code PIN --}}
                    <div class="row items-center x-gap-30 y-gap-20 d-none" id="modal-pin-{{ $reservation->id }}" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10000; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 300px;">
                        <div class="col-12 text-left">
                            <h4 class="text-16 fw-600 mb-10">Validation Session</h4>
                            <p class="text-13 text-light-1 mb-15">Veuillez entrer le code à 4 chiffres fourni par l'artiste.</p>
                            <form action="{{ route('reservations.complete', $reservation->id) }}" method="POST">
                                @csrf
                                <div class="mb-15">
                                    <input type="text" name="pin_code" class="form-control text-20 text-center fw-600 tracking-wider h-50" placeholder="0000" maxlength="4" required pattern="\d{4}">
                                </div>
                                <div class="d-flex x-gap-10">
                                    <button type="submit" class="button -sm bg-blue-1 text-white px-15 py-5 rounded-4 text-13 fw-500 w-1/1">Valider</button>
                                    <button type="button" class="button -sm bg-light-2 text-dark-1 px-15 py-5 rounded-4 text-13 fw-500" onclick="document.getElementById('modal-pin-{{ $reservation->id }}').classList.add('d-none')">Fermer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        document.querySelector('[data-x-click="modal-pin-{{ $reservation->id }}"]').addEventListener('click', function() {
                            document.getElementById('modal-pin-{{ $reservation->id }}').classList.remove('d-none');
                        });
                    </script>
                @else
                    {{-- Annulée / Refusée / Terminée → Aucune action possible --}}
                    <span class="text-light-1 text-13">—</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

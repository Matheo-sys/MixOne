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
            <td data-label="Client">{{ $reservation->client->first_name ?? '' }} {{ $reservation->client->last_name ?? $reservation->client->email }}</td>
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
                    $paymentStatus = $reservation->payment_status;
                @endphp
                <span class="rounded-100 py-4 px-10 text-center text-13 fw-500 {{ $statusClasses[$lowStatus] ?? 'bg-light-3' }}">
                    {{ ucfirst($lowStatus) }}
                </span>
                @if($paymentStatus === \App\Enums\PaymentStatus::Paid)
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-green-1 text-green-2 mt-5 d-inline-block">💳 Payé</span>
                @elseif($paymentStatus === \App\Enums\PaymentStatus::Refunded)
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-blue-1-05 text-blue-1 mt-5 d-inline-block">💳 Remboursé</span>
                @elseif($paymentStatus === \App\Enums\PaymentStatus::Cancelled)
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-red-3 text-red-2 mt-5 d-inline-block">💳 Annulé</span>
                @endif
            </td>
            <td data-label="Action">
                @php $s = $lowStatus; @endphp
                @if($s === 'en attente')
                    {{-- En attente → Le studio peut Confirmer ou Refuser via des boutons --}}
                    <div class="d-flex x-gap-10 y-gap-5 flex-wrap">
                        <form action="{{ route('reservations.confirm', $reservation->uuid) }}" method="POST">
                            @csrf
                            <button type="submit" class="button -sm bg-blue-1 text-white px-15 py-5 rounded-4 text-13 fw-500">
                                Confirmer
                            </button>
                        </form>
                        <form action="{{ route('reservations.refuse', $reservation->uuid) }}" method="POST">
                            @csrf
                            <button type="submit" class="button -sm bg-red-2 text-white px-15 py-5 rounded-4 text-13 fw-500">
                                Refuser
                            </button>
                        </form>
                    </div>
                @elseif($s === 'confirmée')
                    {{-- Confirmée → Le studio peut Terminer ou Signaler un litige --}}
                    <div class="d-flex x-gap-10 y-gap-5 flex-wrap flex-column">
                        <button type="button" class="button -sm bg-green-1 text-green-2 px-15 py-5 rounded-4 text-13 fw-500 w-1/1 js-pin-modal" data-uuid="{{ $reservation->uuid }}" title="Marquer comme payée / effectuée">
                            Terminer (Code PIN)
                        </button>
                        
                        <form action="{{ route('reservations.dispute', $reservation->uuid) }}" method="POST" onsubmit="confirmAction(event, this, 'Êtes-vous sûr de vouloir signaler un problème ? Les fonds seront bloqués.');">
                            @csrf
                            <button type="submit" class="button -sm bg-red-1 text-white px-15 py-5 rounded-4 text-13 fw-500 w-1/1">
                                Signaler un litige
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // === Code PIN via SweetAlert2 ===
    document.querySelectorAll('.js-pin-modal').forEach(btn => {
        btn.addEventListener('click', function() {
            const uuid = this.dataset.uuid;
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            Swal.fire({
                title: '🔐 Validation de Session',
                html: `
                    <p style="color:#777; font-size:14px; margin-bottom:18px;">
                        Entrez le code PIN à 4 chiffres fourni par l'artiste pour valider la session et débloquer votre paiement.
                    </p>
                    <input id="swal-pin-input" class="swal2-input" type="text" inputmode="numeric" maxlength="4" pattern="\\d{4}" placeholder="• • • •"
                        style="text-align:center; font-size:32px; letter-spacing:14px; font-weight:700; width:200px; border-radius:12px; border:2px solid #e5e7eb;">
                `,
                confirmButtonText: 'Valider la session',
                confirmButtonColor: '#3554D1',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                focusConfirm: false,
                didOpen: () => {
                    const input = document.getElementById('swal-pin-input');
                    input.focus();
                    input.addEventListener('input', (e) => {
                        e.target.value = e.target.value.replace(/\D/g, '').slice(0, 4);
                    });
                },
                preConfirm: () => {
                    const pin = document.getElementById('swal-pin-input').value;
                    if (!pin || pin.length !== 4 || !/^\d{4}$/.test(pin)) {
                        Swal.showValidationMessage('Veuillez entrer un code à 4 chiffres.');
                        return false;
                    }
                    return pin;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = `/tableau-de-bord/reservation/${uuid}/terminer`;
                    form.innerHTML = `<input type="hidden" name="_token" value="${csrfToken}"><input type="hidden" name="pin_code" value="${result.value}">`;
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        });
    });

    // === Confirmation Réservation (Confirmer) ===
    document.querySelectorAll('form[action*="confirmer"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const f = this;
            Swal.fire({
                title: 'Confirmer la réservation ?',
                text: "L'artiste recevra un email avec son Code PIN pour la session.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3554D1',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Oui, confirmer',
                cancelButtonText: 'Annuler'
            }).then((result) => { if (result.isConfirmed) f.submit(); });
        });
    });

    // === Refus Réservation ===
    document.querySelectorAll('form[action*="refuser"]').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const f = this;
            Swal.fire({
                title: 'Refuser cette réservation ?',
                text: "L'artiste sera automatiquement remboursé.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'Oui, refuser',
                cancelButtonText: 'Annuler'
            }).then((result) => { if (result.isConfirmed) f.submit(); });
        });
    });
});
</script>
@endpush

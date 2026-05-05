<table class="table-3 -border-bottom col-12 table-responsive-cards" style="font-size: 14px;">
    <thead class="bg-light-2">
    <tr>
        <th>Studio</th>
        <th>Séance</th>
        <th>Durée</th>
        <th>Total</th>
        <th>Statut</th>
        <th style="width: 100px;">Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($rows as $reservation)
        <tr>
            <td data-label="Studio">
                <span class="fw-500 text-blue-1">#{{ $reservation->id }}</span><br>
                {{ \Illuminate\Support\Str::limit($reservation->studio->name ?? '—', 20) }}
            </td>
            <td data-label="Séance" class="lh-14">
                {{ \Carbon\Carbon::parse($reservation->time_slot)->format('d/m/Y') }}<br>
                <span class="text-light-1 text-12">{{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }} - {{ \Carbon\Carbon::parse($reservation->time_slot)->addHours($reservation->number_of_hours)->format('H:i') }}</span>
            </td>
            <td data-label="Durée" class="fw-500">{{ $reservation->number_of_hours }}h</td>
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
                <span class="rounded-100 py-4 px-10 text-center text-12 fw-500 {{ $statusClasses[$lowStatus] ?? 'bg-light-3' }}">
                    {{ ucfirst($lowStatus) }}
                </span>
                @if($paymentStatus === \App\Enums\PaymentStatus::Paid)
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-green-1 text-green-2 mt-5 d-inline-block">💳 Payé</span>
                @elseif($paymentStatus === \App\Enums\PaymentStatus::Pending && $currentStatus === \App\Enums\ReservationStatus::Pending)
                    <a href="{{ route('payment.checkout', $reservation->id) }}" class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-yellow-4 text-dark-1 mt-5 d-inline-block">
                        💳 Payer
                    </a>
                @elseif($paymentStatus === \App\Enums\PaymentStatus::Refunded)
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-blue-1-05 text-blue-1 mt-5 d-inline-block">💳 Remboursé</span>
                @elseif($paymentStatus === \App\Enums\PaymentStatus::Cancelled)
                    <span class="rounded-100 py-4 px-10 text-center text-11 fw-500 bg-red-3 text-red-2 mt-5 d-inline-block">💳 Annulé</span>
                @endif
            </td>
            <td data-label="Action">
                @php $s = $lowStatus; @endphp
                @if($s === 'en attente')
                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button -sm bg-light-2 text-red-1 px-10 py-5 rounded-4 text-12 fw-500">
                            Annuler
                        </button>
                    </form>
                @elseif($s === 'confirmée')
                    @if($reservation->pin_code)
                        <div class="mb-5">
                            <span class="text-11 text-light-1">Code PIN Studio :</span>
                            <div class="fw-600 text-14 bg-light-2 px-10 py-5 rounded-4 d-inline-block">{{ $reservation->pin_code }}</div>
                        </div>
                    @endif
                    <button class="button -sm bg-red-1 text-white px-10 py-5 rounded-4 text-11 fw-500 w-1/1" data-x-click="modal-dispute-{{ $reservation->id }}">
                        Signaler un litige
                    </button>

                    <div class="row items-center x-gap-30 y-gap-20 d-none" id="modal-dispute-{{ $reservation->id }}" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10000; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 400px; max-width: 95vw;">
                        <div class="col-12 text-left">
                            <h4 class="text-18 fw-600 mb-10 text-red-1">Signaler un problème</h4>
                            <p class="text-13 text-light-1 mb-20">Expliquez précisément le problème pour que l'administration puisse trancher équitablement. Les fonds seront bloqués.</p>
                            
                            <form action="{{ route('reservations.dispute', $reservation->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-15">
                                    <label class="text-14 fw-500 mb-5">Raison courte</label>
                                    <input type="text" name="dispute_reason" class="form-control text-14" placeholder="Ex: Studio fermé, matériel cassé..." required>
                                </div>

                                <div class="mb-15">
                                    <label class="text-14 fw-500 mb-5">Description détaillée</label>
                                    <textarea name="dispute_description" class="form-control text-14" rows="4" placeholder="Donnez un maximum de détails..." required></textarea>
                                </div>

                                <div class="mb-20">
                                    <label class="text-14 fw-500 mb-5">Preuve visuelle (Photo)</label>
                                    <input type="file" name="dispute_image" class="form-control text-14" accept="image/*">
                                    <div class="text-11 text-light-1 mt-5">Optionnel mais fortement recommandé.</div>
                                </div>

                                <div class="d-flex x-gap-10">
                                    <button type="submit" class="button -sm bg-red-1 text-white px-20 py-10 rounded-4 text-14 fw-500">Envoyer le signalement</button>
                                    <button type="button" class="button -sm bg-light-2 text-dark-1 px-15 py-10 rounded-4 text-14 fw-500" onclick="document.getElementById('modal-dispute-{{ $reservation->id }}').classList.add('d-none')">Annuler</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        document.querySelector('[data-x-click="modal-dispute-{{ $reservation->id }}"]').addEventListener('click', function(e) {
                            e.preventDefault();
                            document.getElementById('modal-dispute-{{ $reservation->id }}').classList.remove('d-none');
                        });
                    </script>
                @elseif($s === 'terminée' && !$reservation->rating)
                    <button class="button -sm bg-blue-1 text-white px-10 py-5 rounded-4 text-12 fw-500" data-x-click="modal-rate-{{ $reservation->id }}">
                        Noter
                    </button>

                    <div class="row items-center x-gap-30 y-gap-20 d-none" id="modal-rate-{{ $reservation->id }}" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10000; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); width: 300px;">
                        <div class="col-12 text-left">
                            <h4 class="text-16 fw-600 mb-15">Noter la session</h4>
                            <form action="{{ route('reservations.rate', $reservation->id) }}" method="POST">
                                @csrf
                                <div class="mb-10">
                                    <label class="text-13 text-light-1 mb-5">Note (1 à 5)</label>
                                    <select name="rating" class="form-control text-14" required>
                                        <option value="5">5 - Excellent</option>
                                        <option value="4">4 - Très bien</option>
                                        <option value="3">3 - Moyen</option>
                                        <option value="2">2 - Passable</option>
                                        <option value="1">1 - Décevant</option>
                                    </select>
                                </div>
                                <div class="mb-15">
                                    <label class="text-13 text-light-1 mb-5">Avis</label>
                                    <textarea name="comment" class="form-control text-14" rows="2" placeholder="Facultatif"></textarea>
                                </div>
                                <div class="d-flex x-gap-10">
                                    <button type="submit" class="button -sm bg-blue-1 text-white px-15 py-5 rounded-4 text-13 fw-500">Ok</button>
                                    <button type="button" class="button -sm bg-light-2 text-dark-1 px-15 py-5 rounded-4 text-13 fw-500" onclick="document.getElementById('modal-rate-{{ $reservation->id }}').classList.add('d-none')">Fermer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <script>
                        document.querySelector('[data-x-click="modal-rate-{{ $reservation->id }}"]').addEventListener('click', function() {
                            document.getElementById('modal-rate-{{ $reservation->id }}').classList.remove('d-none');
                        });
                    </script>
                @elseif($reservation->rating)
                    <div class="d-flex x-gap-2 items-center">
                        @for($i = 1; $i <= 5; $i++)
                            <div class="icon-star {{ $i <= $reservation->rating ? 'text-yellow-1' : 'text-10' }} {{ $i > $reservation->rating ? 'text-light-3' : '' }}"></div>
                        @endfor
                    </div>
                @else
                    <span class="text-light-1 text-13">—</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

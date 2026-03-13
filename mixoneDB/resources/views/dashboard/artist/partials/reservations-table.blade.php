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
                    $lowStatus = strtolower($reservation->status);
                @endphp
                <span class="rounded-100 py-4 px-10 text-center text-12 fw-500 {{ $statusClasses[$lowStatus] ?? 'bg-light-3' }}">
                    {{ ucfirst($reservation->status) }}
                </span>
            </td>
            <td data-label="Action">
                @php $s = strtolower($reservation->status); @endphp
                @if($s === 'en attente')
                    <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button -sm bg-light-2 text-red-1 px-10 py-5 rounded-4 text-12 fw-500">
                            Annuler
                        </button>
                    </form>
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

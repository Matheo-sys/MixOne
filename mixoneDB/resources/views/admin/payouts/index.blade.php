@extends('layouts.admin')

@section('title', 'Gestion des Virements')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Virements</h1>
        <div class="text-15 text-light-1">Demandes de retrait des studios.</div>
    </div>
</div>

<div class="py-30 px-30 rounded-4 bg-white shadow-3">
    
    {{-- Barre de filtres --}}
    <div class="row y-gap-20 items-center justify-between pb-30">
        <div class="col-12">
            <form action="{{ route('admin.payouts.index') }}" method="GET" class="row y-gap-20 items-end">
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Recherche</div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, Pseudo..." class="border-light rounded-4 px-15 py-10">
                </div>
                
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Statut</div>
                    <select name="status" class="form-select border-light rounded-4 px-15 py-10">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Effectué</option>
                    </select>
                </div>
                
                <div class="col-auto">
                    <button type="submit" class="button -md bg-blue-1 text-white px-20">Filtrer</button>
                </div>
                
                @if(request()->anyFilled(['search', 'status']))
                <div class="col-auto">
                    <a href="{{ route('admin.payouts.index') }}" class="button -md bg-light-2 text-dark-1 px-20">Réinitialiser</a>
                </div>
                @endif
            </form>
        </div>
    </div>

    <div class="overflow-scroll scroll-bar-1">
        <table class="table-3 -border-bottom col-12">
            <thead class="bg-light-2">
                <tr>
                    <th>Date</th>
                    <th>Bénéficiaire</th>
                    <th>Montant</th>
                    <th>IBAN</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($payouts as $payout)
                <tr>
                    <td>{{ $payout->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <div class="fw-500">{{ $payout->utilisateur->first_name }} {{ $payout->utilisateur->last_name }}</div>
                        <div class="text-13 text-light-1">{{ '@' . $payout->utilisateur->username }}</div>
                    </td>
                    <td class="text-blue-1 fw-600">{{ number_format($payout->amount, 2) }} €</td>
                    <td class="text-14">{{ $payout->iban }}</td>
                    <td>
                        @if($payout->status == 'pending')
                            <span class="badge bg-yellow-1 text-yellow-2">En attente</span>
                        @else
                            <span class="badge bg-green-1 text-white">Effectué</span>
                        @endif
                    </td>
                    <td>
                        @if($payout->status == 'pending')
                        <form action="{{ route('admin.payouts.complete', $payout) }}" method="POST">
                            @csrf
                            <button type="submit" class="button -sm -blue-1 text-white">Marquer comme fait</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-20 text-light-1">Aucune demande de virement.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-20">
        {{ $payouts->links() }}
    </div>
</div>
@endsection

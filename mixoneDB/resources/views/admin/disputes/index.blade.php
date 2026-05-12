@extends('layouts.admin')

@section('title', 'Gestion des Litiges')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Litiges</h1>
        <div class="text-15 text-light-1">Sessions signalées par les utilisateurs.</div>
    </div>
</div>

<div class="py-30 px-30 rounded-4 bg-white shadow-3">
    
    {{-- Barre de filtres --}}
    <div class="row y-gap-20 items-center justify-between pb-30">
        <div class="col-12">
            <form action="{{ route('admin.disputes.index') }}" method="GET" class="row y-gap-20 items-end">
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Recherche</div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="ID, Artiste, Studio..." class="border-light rounded-4 px-15 py-10">
                </div>
                
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Statut</div>
                    <select name="status" class="form-select border-light rounded-4 px-15 py-10">
                        <option value="pending" {{ request('status') != 'all' ? 'selected' : '' }}>Litiges en cours</option>
                        <option value="all" {{ request('status') == 'all' ? 'selected' : '' }}>Historique complet</option>
                    </select>
                </div>
                
                <div class="col-auto">
                    <button type="submit" class="button -md bg-blue-1 text-white px-20">Filtrer</button>
                </div>
                
                @if(request()->anyFilled(['search', 'status']) && request('status') == 'all' || request()->filled('search'))
                <div class="col-auto">
                    <a href="{{ route('admin.disputes.index') }}" class="button -md bg-light-2 text-dark-1 px-20">Réinitialiser</a>
                </div>
                @endif
            </form>
        </div>
    </div>

    <div class="overflow-scroll scroll-bar-1">
        <table class="table-3 -border-bottom col-12">
            <thead class="bg-light-2">
                <tr>
                    <th>Date Litige</th>
                    <th>Réservation</th>
                    <th>Artiste</th>
                    <th>Studio</th>
                    <th>Raison</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($disputes as $dispute)
                <tr>
                    <td class="text-14">{{ $dispute->disputed_at ? $dispute->disputed_at->format('d/m/Y H:i') : 'N/A' }}</td>
                    <td class="fw-500">#{{ $dispute->id }}</td>
                    <td class="text-15">
                        <div class="fw-500">{{ $dispute->client->first_name ?? 'Inconnu' }} {{ $dispute->client->last_name ?? '' }}</div>
                        @if($dispute->client)
                            <div class="text-13 text-light-1">{{ '@' . $dispute->client->username }}</div>
                        @endif
                    </td>
                    <td class="text-blue-1 fw-500">
                        {{ $dispute->studio->name ?? 'Studio supprimé' }}
                    </td>
                    <td class="text-light-1 text-14" style="max-width: 250px;">{{ $dispute->dispute_reason }}</td>
                    <td>
                        <a href="{{ route('admin.disputes.show', $dispute) }}" class="button -sm bg-blue-1 text-white px-20 py-5 rounded-4 text-12">
                            <i class="icon-eye mr-5"></i> Gérer le litige
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-20 text-light-1">Aucun litige en attente.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-20">
        {{ $disputes->links() }}
    </div>
</div>
@endsection

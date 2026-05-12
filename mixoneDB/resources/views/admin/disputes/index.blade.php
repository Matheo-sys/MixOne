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
                        {{ $dispute->client->first_name ?? 'Inconnu' }} {{ $dispute->client->last_name ?? '' }}
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

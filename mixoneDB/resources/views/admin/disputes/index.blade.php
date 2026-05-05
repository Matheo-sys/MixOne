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
                    <td>{{ $dispute->disputed_at ? $dispute->disputed_at->format('d/m/Y H:i') : 'N/A' }}</td>
                    <td class="fw-500">#{{ $dispute->id }}</td>
                    <td>{{ $dispute->user->first_name }} {{ $dispute->user->last_name }}</td>
                    <td>{{ $dispute->studio->title }}</td>
                    <td class="text-light-1">{{ $dispute->dispute_reason }}</td>
                    <td>
                        <div class="d-flex x-gap-10">
                            <form action="{{ route('admin.disputes.resolve', $dispute) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="complete">
                                <button type="submit" class="button -sm -blue-1 text-white">Terminer (Payer Studio)</button>
                            </form>
                            <form action="{{ route('admin.disputes.resolve', $dispute) }}" method="POST">
                                @csrf
                                <input type="hidden" name="action" value="cancel">
                                <button type="submit" class="button -sm -red-1 text-white">Annuler (Rembourser)</button>
                            </form>
                        </div>
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

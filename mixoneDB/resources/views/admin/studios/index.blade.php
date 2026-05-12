@extends('layouts.admin')

@section('title', 'Gestion des Studios')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Studios</h1>
        <div class="text-15 text-light-1">Liste de tous les studios d'enregistrement.</div>
    </div>
</div>

<div class="py-30 px-30 rounded-4 bg-white shadow-3">
    
    {{-- Barre de filtres --}}
    <div class="row y-gap-20 items-center justify-between pb-30">
        <div class="col-12">
            <form action="{{ route('admin.studios.index') }}" method="GET" class="row y-gap-20 items-end">
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Recherche</div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, Ville, Pseudo proprio..." class="border-light rounded-4 px-15 py-10">
                </div>
                
                <div class="col-auto">
                    <div class="text-14 fw-500 mb-5">Statut de validation</div>
                    <select name="status" class="form-select border-light rounded-4 px-15 py-10">
                        <option value="">Tous</option>
                        <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Vérifié</option>
                        <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Non vérifié</option>
                    </select>
                </div>
                
                <div class="col-auto">
                    <button type="submit" class="button -md bg-blue-1 text-white px-20">Filtrer</button>
                </div>
                
                @if(request()->anyFilled(['search', 'status']))
                <div class="col-auto">
                    <a href="{{ route('admin.studios.index') }}" class="button -md bg-light-2 text-dark-1 px-20">Réinitialiser</a>
                </div>
                @endif
            </form>
        </div>
    </div>

    <div class="overflow-scroll scroll-bar-1">
        <table class="table-3 -border-bottom col-12">
            <thead class="bg-light-2">
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Nom du Studio</th>
                    <th>Propriétaire</th>
                    <th>Ville</th>
                    <th>Prix / H</th>
                    <th>Vérifié</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($studios as $studio)
                <tr>
                    <td>#{{ $studio->id }}</td>
                    <td>
                        <div class="size-40 rounded-4 overflow-hidden">
                            <img src="{{ $studio->image1 ? storage_url($studio->image1) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="h-full w-full object-cover">
                        </div>
                    </td>
                    <td class="fw-500">{{ $studio->name }}</td>
                    <td>
                        <div class="fw-500">{{ $studio->proprietaire->first_name ?? 'Inconnu' }} {{ $studio->proprietaire->last_name ?? '' }}</div>
                        @if($studio->proprietaire)
                            <div class="text-13 text-light-1">{{ '@' . $studio->proprietaire->username }}</div>
                        @endif
                    </td>
                    <td>{{ $studio->city }}</td>
                    <td>{{ $studio->hourly_rate }} €</td>
                    <td>
                        @if($studio->is_verified)
                            <span class="fw-600" style="color: #05a011 !important;">Oui</span>
                        @else
                            <span class="text-light-1">Non</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex x-gap-10">
                            <a href="{{ route('studios.show', $studio) }}" target="_blank" class="px-15 py-5 bg-blue-1 text-white rounded-4 text-14 fw-500">Voir site</a>
                            
                            <form action="{{ route('admin.studios.toggle-verify', $studio) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-15 py-5 {{ $studio->is_verified ? 'bg-light-2 text-dark-1' : 'text-white' }} rounded-4 text-14 fw-500" style="{{ $studio->is_verified ? '' : 'background-color: #05a011 !important;' }}">
                                    {{ $studio->is_verified ? 'Retirer vérif.' : 'Vérifier' }}
                                </button>
                            </form>

                            <form action="{{ route('admin.studios.destroy', $studio) }}" method="POST" onsubmit="confirmAction(event, this, 'Supprimer ce studio définitivement ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-15 py-5 bg-red-1 text-white rounded-4 text-14 fw-500">Supprimer</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-20 text-light-1">Aucun studio trouvé.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-20">
        {{ $studios->links() }}
    </div>
</div>
@endsection

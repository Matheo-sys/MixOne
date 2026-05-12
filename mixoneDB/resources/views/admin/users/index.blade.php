@extends('layouts.admin')

@section('title', 'Gestion des Utilisateurs')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Utilisateurs</h1>
        <div class="text-15 text-light-1">Liste de tous les inscrits sur la plateforme.</div>
    </div>
</div>

<div class="py-30 px-30 rounded-4 bg-white shadow-3">
    <div class="tabs -underline-2 js-tabs">
        <div class="tabs__content pt-30 js-tabs-content">
            <div class="tabs__pane -tab-item-1 is-tab-el-active">
                
                {{-- Barre de filtres --}}
                <div class="row y-gap-20 items-center justify-between pb-30">
                    <div class="col-12">
                        <form action="{{ route('admin.users.index') }}" method="GET" class="row y-gap-20 items-end">
                            <div class="col-auto">
                                <div class="text-14 fw-500 mb-5">Recherche</div>
                                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nom, Email, Username..." class="border-light rounded-4 px-15 py-10">
                            </div>
                            
                            <div class="col-auto">
                                <div class="text-14 fw-500 mb-5">Profil</div>
                                <select name="profile" class="form-select border-light rounded-4 px-15 py-10">
                                    <option value="">Tous les profils</option>
                                    <option value="artist" {{ request('profile') == 'artist' ? 'selected' : '' }}>Artiste</option>
                                    <option value="studio" {{ request('profile') == 'studio' ? 'selected' : '' }}>Studio</option>
                                </select>
                            </div>
                            
                            <div class="col-auto">
                                <div class="text-14 fw-500 mb-5">Statut</div>
                                <select name="status" class="form-select border-light rounded-4 px-15 py-10">
                                    <option value="">Tous les statuts</option>
                                    <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Vérifié</option>
                                    <option value="unverified" {{ request('status') == 'unverified' ? 'selected' : '' }}>Non vérifié</option>
                                    <option value="banned" {{ request('status') == 'banned' ? 'selected' : '' }}>Banni</option>
                                </select>
                            </div>
                            
                            <div class="col-auto">
                                <button type="submit" class="button -md -blue-1 text-white px-20">Filtrer</button>
                            </div>
                            
                            @if(request()->anyFilled(['search', 'profile', 'status']))
                            <div class="col-auto">
                                <a href="{{ route('admin.users.index') }}" class="button -md -light-1 text-dark-1 px-20">Réinitialiser</a>
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
                                <th>Nom complet</th>
                                <th>Email</th>
                                <th>Rôle</th>
                                <th>Date d'inscription</th>
                                <th>Statut</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>#{{ $user->id }}</td>
                                <td class="fw-500">{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->profile == 'artist')
                                        <span class="badge bg-blue-1-05 text-blue-1">Artiste</span>
                                    @else
                                        <span class="badge bg-purple-1-05 text-purple-1">Studio</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                <td>
                                    @if($user->banned_at)
                                        <span class="text-red-1 fw-500">Banni</span>
                                    @elseif($user->email_verified_at)
                                        <span class="fw-600" style="color: #05a011 !important;">Vérifié</span>
                                    @else
                                        <span class="text-light-1">Non vérifié</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex x-gap-10 items-center">
                                        <a href="{{ route('admin.users.show', $user) }}" class="px-15 py-5 bg-blue-1 text-white rounded-4 text-14 fw-500">Détails</a>
                                        
                                        @if(!$user->email_verified_at && !$user->banned_at)
                                            <form action="{{ route('admin.users.verify-email', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-15 py-5 text-white rounded-4 text-14 fw-500" style="background-color: #05a011 !important;">Vérifier Email</button>
                                            </form>
                                        @endif

                                        @if($user->banned_at)
                                            <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="px-15 py-5 text-white rounded-4 text-14 fw-500" style="background-color: #05a011 !important;">Débannir</button>
                                            </form>
                                        @else
                                            <form action="{{ route('admin.users.ban', $user) }}" method="POST" onsubmit="let reason = prompt('Raison du bannissement :', 'Violation des conditions d\'utilisation.'); if(reason === null) return false; this.querySelector('input[name=reason]').value = reason; return true;">
                                                @csrf
                                                <input type="hidden" name="reason" value="">
                                                <button type="submit" class="px-15 py-5 bg-red-1 text-white rounded-4 text-14 fw-500">Bannir</button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-20 text-light-1">Aucun utilisateur trouvé.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-20">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

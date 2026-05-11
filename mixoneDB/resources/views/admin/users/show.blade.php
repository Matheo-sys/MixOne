@extends('layouts.admin')

@section('title', 'Détails Utilisateur - ' . $user->first_name . ' ' . $user->last_name)

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Fiche Utilisateur</h1>
        <div class="text-15 text-light-1">Consultation approfondie et gestion du compte.</div>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="button -md -light-1 text-dark-1">
            <i class="icon-arrow-left text-14 mr-10"></i>
            Retour à la liste
        </a>
    </div>
</div>

<div class="row y-gap-30">
    {{-- Colonne de gauche : Profil et Actions --}}
    <div class="col-xl-4">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="d-flex flex-column items-center text-center">
                <div class="relative">
                    <img src="{{ $user->avatar ? storage_url($user->avatar) : asset('media/images/avatar-default.png') }}" 
                         alt="avatar" class="size-120 rounded-full object-cover mb-20 border-light">
                    @if($user->is_admin)
                        <div class="absolute bottom-10 right-0 bg-purple-1 text-white size-32 rounded-full flex-center border-white-2" title="Administrateur">
                            <i class="icon-shield text-14"></i>
                        </div>
                    @endif
                </div>
                
                <h2 class="text-22 fw-500">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <div class="text-15 text-light-1 mb-10">{{ $user->email }}</div>
                <div class="text-14 text-light-1 mb-20">ID: {{ $user->uuid }}</div>

                <div class="d-flex x-gap-10 mb-30">
                    @if($user->profile == 'artist')
                        <span class="badge bg-blue-1-05 text-blue-1 px-15 py-5 text-14">Artiste</span>
                    @else
                        <span class="badge bg-purple-1-05 text-purple-1 px-15 py-5 text-14">Studio</span>
                    @endif
                    
                    @if($user->is_admin)
                        <span class="badge bg-red-1-05 text-red-1 px-15 py-5 text-14">Admin</span>
                    @endif
                </div>

                <div class="w-100 border-top-light pt-30">
                    <h4 class="text-16 fw-500 mb-20 text-left">Actions de gestion</h4>
                    
                    <div class="row y-gap-15">
                        {{-- Bouton Admin --}}
                        <div class="col-12">
                            <form action="{{ route('admin.users.toggle-admin', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="button -md {{ $user->is_admin ? '-light-1 text-red-1' : 'bg-purple-1 text-white' }} w-100">
                                    <i class="icon-shield text-16 mr-10"></i>
                                    {{ $user->is_admin ? 'Retirer les droits Admin' : 'Nommer Administrateur' }}
                                </button>
                            </form>
                        </div>

                        {{-- Bouton Bannir/Débannir --}}
                        <div class="col-12">
                            @if($user->banned_at)
                                <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button -md -blue-1 text-white w-100">
                                        <i class="icon-check text-16 mr-10"></i> Débannir
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('admin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Bannir cet utilisateur ?');">
                                    @csrf
                                    <button type="submit" class="button -md -red-1 text-white w-100">
                                        <i class="icon-close text-16 mr-10"></i> Bannir
                                    </button>
                                </form>
                            @endif
                        </div>

                        {{-- Bouton Vérification Email --}}
                        @if(!$user->email_verified_at)
                            <div class="col-12">
                                <form action="{{ route('admin.users.verify-email', $user) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="button -md bg-green-1 text-white w-100">
                                        <i class="icon-email text-16 mr-10"></i> Vérifier l'email
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Colonne de droite : Détails et Historique --}}
    <div class="col-xl-8">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 js-tabs-controls">
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Informations</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button" data-tab-target=".-tab-item-2">Studios ({{ $user->studios->count() }})</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button" data-tab-target=".-tab-item-3">Réservations ({{ $user->reservations->count() + $user->reservationsRecues->count() }})</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button" data-tab-target=".-tab-item-4">Transactions</button>
                </div>
            </div>

            <div class="tabs__content pt-30 js-tabs-content">
                {{-- Onglet Informations --}}
                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <div class="row y-gap-30">
                            <div class="col-sm-6">
                                <div class="text-15 text-light-1">Nom complet</div>
                                <div class="text-16 fw-500">{{ $user->first_name }} {{ $user->last_name }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-15 text-light-1">Pseudo</div>
                                <div class="text-16 fw-500">{{ $user->username ?? 'Non défini' }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-15 text-light-1">Téléphone</div>
                                <div class="text-16 fw-500">{{ $user->phone ?? 'Non renseigné' }}</div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-15 text-light-1">Date de naissance</div>
                                <div class="text-16 fw-500">{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'Non renseignée' }}</div>
                            </div>
                            <div class="col-12 border-top-light pt-20">
                                <div class="text-15 text-light-1">Adresse complète</div>
                                <div class="text-16 fw-500">
                                    {{ $user->address_line1 }} {{ $user->address_line2 }}<br>
                                    {{ $user->zipcode }} {{ $user->city }}, {{ $user->country }}
                                </div>
                            </div>
                            <div class="col-12 border-top-light pt-20">
                                <div class="text-15 text-light-1">À propos / Bio</div>
                                <div class="text-16 lh-16">{{ $user->about ?? 'Aucune description.' }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Onglet Studios --}}
                <div class="tabs__pane -tab-item-2">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        @forelse($user->studios as $studio)
                            <div class="row y-gap-20 justify-between items-center {{ !$loop->last ? 'border-bottom-light pb-20 mb-20' : '' }}">
                                <div class="col-auto">
                                    <div class="d-flex items-center x-gap-20">
                                        <img src="{{ $studio->image1 ? storage_url($studio->image1) : asset('media/img/backgrounds/11.jpg') }}" alt="studio" class="size-60 rounded-4 object-cover">
                                        <div>
                                            <div class="text-16 fw-500">{{ $studio->name }}</div>
                                            <div class="text-14 text-light-1">{{ $studio->city }} - {{ $studio->hourly_rate }}€/h</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('studios.show', $studio) }}" target="_blank" class="button -sm bg-blue-1-05 text-blue-1">Voir</a>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-20">
                                <i class="icon-home text-40 text-light-1 mb-10"></i>
                                <div class="text-light-1">Cet utilisateur ne possède aucun studio.</div>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Onglet Réservations --}}
                <div class="tabs__pane -tab-item-3">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        @php
                            $allReservations = $user->reservations->merge($user->reservationsRecues)->sortByDesc('created_at');
                        @endphp
                        
                        <div class="overflow-scroll scroll-bar-1">
                            <table class="table-2 col-12">
                                <thead class="bg-light-2">
                                    <tr>
                                        <th>Date</th>
                                        <th>Studio</th>
                                        <th>Client/Artiste</th>
                                        <th>Prix</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allReservations as $res)
                                        <tr>
                                            <td>{{ $res->date->format('d/m/Y') }} à {{ $res->time_slot }}</td>
                                            <td>{{ $res->studio->name }}</td>
                                            <td>
                                                @if($res->user_id === $user->id)
                                                    <span class="text-blue-1">Moi (Client)</span>
                                                @else
                                                    {{ $res->user->first_name }} (Propriétaire)
                                                @endif
                                            </td>
                                            <td>{{ $res->total_price }} €</td>
                                            <td>
                                                <span class="badge 
                                                    @if($res->status == 'confirmed') bg-green-1-05 text-green-1
                                                    @elseif($res->status == 'pending') bg-yellow-1-05 text-yellow-1
                                                    @else bg-red-1-05 text-red-1 @endif">
                                                    {{ ucfirst($res->status) }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-20 text-light-1">Aucune réservation.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Onglet Transactions --}}
                <div class="tabs__pane -tab-item-4">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <div class="d-flex justify-between items-center mb-30">
                            <div>
                                <div class="text-15 text-light-1">Solde actuel</div>
                                <div class="text-22 fw-600 text-blue-1">{{ number_format($user->portefeuille->solde ?? 0, 2) }} €</div>
                            </div>
                        </div>

                        <div class="overflow-scroll scroll-bar-1">
                            <table class="table-2 col-12">
                                <thead class="bg-light-2">
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($user->portefeuille && $user->portefeuille->transactions)
                                        @forelse($user->portefeuille->transactions as $trans)
                                            <tr>
                                                <td>{{ $trans->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    <span class="badge {{ $trans->type == 'credit' ? 'bg-green-1-05 text-green-1' : 'bg-red-1-05 text-red-1' }}">
                                                        {{ $trans->type == 'credit' ? 'Crédit' : 'Débit' }}
                                                    </span>
                                                </td>
                                                <td>{{ $trans->description }}</td>
                                                <td class="fw-500 {{ $trans->type == 'credit' ? 'text-green-1' : 'text-red-1' }}">
                                                    {{ $trans->type == 'credit' ? '+' : '-' }}{{ $trans->amount }} €
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-20 text-light-1">Aucune transaction.</td>
                                            </tr>
                                        @endforelse
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center py-20 text-light-1">Portefeuille non activé.</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

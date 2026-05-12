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
                <div class="relative mb-20">
                    <img src="{{ $user->avatar ? storage_url($user->avatar) : asset('media/img/misc/avatar-default.png') }}" 
                         alt="avatar" class="size-120 rounded-full object-cover border-light">
                </div>
                <div class="d-flex justify-center items-center text-22 fw-500">
                    {{ $user->first_name }} {{ $user->last_name }} 
                    @if($user->is_admin)
                        <span class="bg-red-1 text-white text-12 fw-600 px-10 py-4 rounded-4 ml-10 d-flex items-center">
                            <i class="icon-shield text-12 mr-5"></i> ADMIN
                        </span>
                    @endif
                </div>
                <div class="text-15 text-light-1 mb-10">{{ $user->email }}</div>
                <div class="text-14 text-light-1 mb-20">ID: {{ $user->uuid }}</div>

                <div class="d-flex x-gap-10 mb-30">
                    @if($user->profile == 'artist')
                        <span class="badge bg-blue-1-05 text-blue-1 px-15 py-5 text-14">Artiste</span>
                    @else
                        <span class="badge bg-purple-1-05 text-purple-1 px-15 py-5 text-14">Studio</span>
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
                                <form action="{{ route('admin.users.ban', $user) }}" method="POST" id="ban-form-{{ $user->id }}">
                                    @csrf
                                    <input type="hidden" name="reason" value="" id="ban-reason-{{ $user->id }}">
                                    <button type="button" class="button -md bg-red-1 text-white w-100" onclick="banUserSwal({{ $user->id }})">
                                        <i class="icon-close text-16 mr-10"></i> Bannir
                                    </button>
                                </form>
                                <script>
                                function banUserSwal(userId) {
                                    Swal.fire({
                                        title: 'Bannir cet utilisateur ?',
                                        html: '<p style="color:#777; font-size:14px;">Cette action empêchera l\'utilisateur de se connecter.</p>',
                                        input: 'textarea',
                                        inputPlaceholder: 'Raison du bannissement...',
                                        inputValue: 'Violation des conditions d\'utilisation.',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d33',
                                        confirmButtonText: 'Bannir',
                                        cancelButtonText: 'Annuler',
                                        inputValidator: (value) => {
                                            if (!value.trim()) return 'Veuillez indiquer la raison du bannissement.';
                                        }
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            document.getElementById('ban-reason-' + userId).value = result.value;
                                            document.getElementById('ban-form-' + userId).submit();
                                        }
                                    });
                                }
                                </script>
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
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button" data-tab-target=".-tab-item-5">Signalements ({{ $reportsReceived->count() + $reportsSent->count() }})</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button" data-tab-target=".-tab-item-6">Litiges ({{ $disputes->count() }})</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button" data-tab-target=".-tab-item-7">Virements ({{ $payouts->count() }})</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 fw-500 js-tabs-button" data-tab-target=".-tab-item-8">Messages</button>
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
                                        <th class="px-20">Date</th>
                                        <th class="px-20">Studio</th>
                                        <th class="px-20">Client/Artiste</th>
                                        <th class="px-20">Prix</th>
                                        <th class="px-20">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($allReservations as $res)
                                        <tr>
                                            <td class="px-20">{{ $res->date->format('d/m/Y') }} à {{ $res->time_slot }}</td>
                                            <td class="px-20">{{ $res->studio?->name ?? 'Studio supprimé' }}</td>
                                            <td class="px-20">
                                                @if($res->user_id === $user->id)
                                                    <span class="text-blue-1">Moi (Client)</span>
                                                @else
                                                    {{ $res->client?->first_name ?? 'Inconnu' }} (Propriétaire)
                                                @endif
                                            </td>
                                            <td class="px-20">{{ $res->price }} €</td>
                                            <td class="px-20">
                                                <span class="badge 
                                                    @if($res->status === \App\Enums\ReservationStatus::Confirmed) bg-green-1-05 text-green-2
                                                    @elseif($res->status === \App\Enums\ReservationStatus::Pending) bg-yellow-1-05 text-yellow-2
                                                    @else bg-red-1-05 text-red-1 @endif">
                                                    {{ $res->status->label() }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-30 text-light-1">
                                                <div class="d-flex flex-column items-center">
                                                    <i class="icon-calendar text-24 mb-10"></i>
                                                    <span>Aucune réservation enregistrée.</span>
                                                </div>
                                            </td>
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
                                <div class="text-22 fw-600 text-blue-1">{{ number_format($user->portefeuille?->solde ?? 0, 2) }} €</div>
                            </div>
                        </div>

                        <div class="overflow-scroll scroll-bar-1">
                            <table class="table-2 col-12">
                                <thead class="bg-light-2">
                                    <tr>
                                        <th class="px-20">Date</th>
                                        <th class="px-20">Type</th>
                                        <th class="px-20">Description</th>
                                        <th class="px-20">Montant</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($user->portefeuille && $user->portefeuille->transactions)
                                        @forelse($user->portefeuille->transactions as $trans)
                                            <tr>
                                                <td class="px-20">{{ $trans->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="px-20">
                                                    <span class="badge {{ $trans->type == 'credit' ? 'bg-green-1-05 text-green-2' : 'bg-red-1-05 text-red-1' }}">
                                                        {{ $trans->type == 'credit' ? 'Crédit' : 'Débit' }}
                                                    </span>
                                                </td>
                                                <td class="px-20">{{ $trans->description }}</td>
                                                <td class="px-20 fw-500 {{ $trans->type == 'credit' ? 'text-green-2' : 'text-red-1' }}">
                                                    {{ $trans->type == 'credit' ? '+' : '-' }}{{ $trans->amount }} €
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-30 text-light-1">
                                                    <div class="d-flex flex-column items-center">
                                                        <i class="icon-payment text-24 mb-10"></i>
                                                        <span>Aucune transaction trouvée.</span>
                                                    </div>
                                                </td>
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

                {{-- Onglet Signalements --}}
                <div class="tabs__pane -tab-item-5">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <h4 class="text-18 fw-500 mb-20">Historique des Signalements</h4>
                        
                        <div class="row y-gap-30">
                            <div class="col-12">
                                <div class="text-16 fw-500 mb-10 text-blue-1">Signalements reçus ({{ $reportsReceived->count() }})</div>
                                <div class="overflow-scroll scroll-bar-1">
                                    <table class="table-2 col-12">
                                        <thead class="bg-light-2">
                                            <tr>
                                                <th class="px-20">Date</th>
                                                <th class="px-20">Par</th>
                                                <th class="px-20">Motif</th>
                                                <th class="px-20">Statut</th>
                                                <th class="px-20">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($reportsReceived as $r)
                                                <tr>
                                                    <td class="px-20">{{ $r->created_at->format('d/m/Y') }}</td>
                                                    <td class="px-20">{{ $r->reporter->first_name }}</td>
                                                    <td class="px-20">{{ $r->reason }}</td>
                                                    <td class="px-20"><span class="badge {{ $r->status == 'pending' ? 'bg-yellow-1-05 text-yellow-2' : 'bg-green-1-05 text-green-2' }}">{{ $r->status }}</span></td>
                                                    <td class="px-20"><a href="{{ route('admin.reports.show', $r) }}" class="text-blue-1">Voir</a></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-30 text-light-1">
                                                        <div class="d-flex flex-column items-center">
                                                            <i class="icon-alert-triangle text-24 mb-10"></i>
                                                            <span>Aucun signalement reçu.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-12 border-top-light pt-30">
                                <div class="text-16 fw-500 mb-10 text-purple-1">Signalements envoyés ({{ $reportsSent->count() }})</div>
                                <div class="overflow-scroll scroll-bar-1">
                                    <table class="table-2 col-12">
                                        <thead class="bg-light-2">
                                            <tr>
                                                <th class="px-20">Date</th>
                                                <th class="px-20">Contre</th>
                                                <th class="px-20">Motif</th>
                                                <th class="px-20">Statut</th>
                                                <th class="px-20">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($reportsSent as $r)
                                                <tr>
                                                    <td>{{ $r->created_at->format('d/m/Y') }}</td>
                                                    <td>{{ $r->reported->first_name }}</td>
                                                    <td>{{ $r->reason }}</td>
                                                    <td><span class="badge {{ $r->status == 'pending' ? 'bg-yellow-1-05 text-yellow-2' : 'bg-green-1-05 text-green-2' }}">{{ $r->status }}</span></td>
                                                    <td><a href="{{ route('admin.reports.show', $r) }}" class="text-blue-1">Voir</a></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5" class="text-center py-30 text-light-1">
                                                        <div class="d-flex flex-column items-center">
                                                            <i class="icon-shield text-24 mb-10"></i>
                                                            <span>Aucun signalement envoyé.</span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Onglet Litiges --}}
                <div class="tabs__pane -tab-item-6">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <table class="table-2 col-12">
                            <thead class="bg-light-2">
                                <tr>
                                    <th class="px-20">Date</th>
                                    <th class="px-20">Studio</th>
                                    <th class="px-20">Montant</th>
                                    <th class="px-20">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($disputes as $d)
                                    <tr>
                                        <td class="px-20">{{ $d->updated_at->format('d/m/Y') }}</td>
                                        <td class="px-20">{{ $d->studio->name }}</td>
                                        <td class="px-20">{{ $d->price }}€</td>
                                        <td class="px-20"><a href="{{ route('admin.disputes.index', ['search' => $d->id]) }}" class="text-blue-1">Voir</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-30 text-light-1">
                                            <div class="d-flex flex-column items-center">
                                                <i class="icon-dispute text-24 mb-10"></i>
                                                <span>Aucun litige en cours.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Onglet Virements --}}
                <div class="tabs__pane -tab-item-7">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <table class="table-2 col-12">
                            <thead class="bg-light-2">
                                <tr>
                                    <th class="px-20">Date</th>
                                    <th class="px-20">Montant</th>
                                    <th class="px-20">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($payouts as $p)
                                    <tr>
                                        <td class="px-20">{{ $p->created_at->format('d/m/Y') }}</td>
                                        <td class="px-20">{{ $p->amount }}€</td>
                                        <td class="px-20"><span class="badge {{ $p->status == 'pending' ? 'bg-yellow-1-05 text-yellow-2' : 'bg-green-1-05 text-green-2' }}">{{ $p->status }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-30 text-light-1">
                                            <div class="d-flex flex-column items-center">
                                                <i class="icon-payment text-24 mb-10"></i>
                                                <span>Aucune demande de virement effectuée.</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Onglet Message Admin --}}
                <div class="tabs__pane -tab-item-8">
                    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                        <h4 class="text-18 fw-500 mb-20">Envoyer un message officiel MixOne</h4>
                        <p class="text-15 text-light-1 mb-20">Ce message apparaîtra dans la messagerie de l'utilisateur avec un badge "Admin".</p>
                        
                        <form action="{{ route('admin.users.send-message', $user) }}" method="POST">
                            @csrf
                            <div class="form-group mb-20">
                                <label class="text-14 fw-500 mb-10">Votre message</label>
                                <textarea name="message" rows="5" class="form-control border-light rounded-4 px-15 py-15" placeholder="Écrivez votre message ici..." required></textarea>
                            </div>
                            <button type="submit" class="button -md bg-blue-1 text-white px-30">
                                Envoyer le message
                            </button>
                        </form>
                    </div>
                </div> {{-- Fin onglet 8 --}}
            </div> {{-- Fin tabs__content --}}
        </div> {{-- Fin tabs --}}
    </div> {{-- Fin col-xl-8 --}}
</div> {{-- Fin row --}}
@endsection

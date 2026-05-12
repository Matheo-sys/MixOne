@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-40">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Administration MixOne</h1>
        <div class="text-15 text-light-1">Cockpit de pilotage de la plateforme.</div>
    </div>
</div>

{{-- SECTION 1 : KPIs PERFORMANCES (30 JOURS) --}}
<h2 class="text-18 fw-500 mb-20">Performances (30 derniers jours)</h2>
<div class="row y-gap-30 mb-40">
    <!-- Volume d'affaires -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Volume Mensuel</div>
                    <div class="text-30 fw-600 mt-5">{{ number_format($volume30Jours, 2) }} €</div>
                    <div class="text-13 text-light-1 mt-5">Total historique: {{ number_format($volumeTotal, 2) }} €</div>
                </div>
                <div class="col-auto">
                    <div class="size-50 bg-blue-1-05 rounded-full flex-center text-blue-1 text-24">
                        <i class="icon-wallet"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Commissions -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Commissions (Gains)</div>
                    <div class="text-30 fw-600 mt-5 text-green-1">{{ number_format($commission30Jours, 2) }} €</div>
                    <div class="text-13 text-light-1 mt-5">Total historique: {{ number_format($commissionTotale, 2) }} €</div>
                </div>
                <div class="col-auto">
                    <div class="size-50 bg-green-1-05 rounded-full flex-center text-green-1 text-24">
                        <i class="icon-menu-2"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Utilisateurs -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Croissance Utilisateurs</div>
                    <div class="text-30 fw-600 mt-5">+{{ $nouveauxUtilisateurs30j }}</div>
                    <div class="text-13 text-light-1 mt-5">Sur un total de {{ $totalUtilisateurs }} inscrits</div>
                </div>
                <div class="col-auto">
                    <div class="size-50 bg-purple-1-05 rounded-full flex-center text-purple-1 text-24">
                        <i class="icon-user"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Réservations -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Nouvelles Réservations</div>
                    <div class="text-30 fw-600 mt-5">{{ $reservations30j }}</div>
                    <div class="text-13 text-light-1 mt-5">Total: {{ $reservationsTotales }} sessions</div>
                </div>
                <div class="col-auto">
                    <div class="size-50 bg-yellow-1-05 rounded-full flex-center text-yellow-1 text-24">
                        <i class="icon-calendar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- SECTION 2 : CENTRE D'ACTION (MODÉRATION & OPÉRATIONS) --}}
<h2 class="text-18 fw-500 mb-20">Centre d'Action</h2>
<div class="row y-gap-30">
    
    {{-- ALERTES FINANCIERES --}}
    <div class="col-xl-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3 border-top-light border-2 {{ ($litigesEnAttente > 0 || $virementsEnAttente > 0) ? 'border-red-1' : '' }}">
            <h3 class="text-16 fw-500 mb-20 flex items-center">
                <i class="icon-alert-triangle text-red-1 mr-10 text-20"></i> Opérations Sensibles
            </h3>
            
            <div class="d-flex justify-between items-center py-10 border-bottom-light">
                <span class="text-15">Litiges en cours (Blocage fonds)</span>
                @if($litigesEnAttente > 0)
                    <a href="{{ route('admin.disputes.index') }}" class="badge bg-red-1 text-white px-15 py-5">{{ $litigesEnAttente }} à traiter</a>
                @else
                    <span class="text-green-1 fw-500"><i class="icon-check"></i> Aucun</span>
                @endif
            </div>

            <div class="d-flex justify-between items-center py-10">
                <span class="text-15">Demandes de virement (Payouts)</span>
                @if($virementsEnAttente > 0)
                    <a href="{{ route('admin.payouts.index') }}" class="badge bg-blue-1 text-white px-15 py-5">{{ $virementsEnAttente }} en attente</a>
                @else
                    <span class="text-green-1 fw-500"><i class="icon-check"></i> À jour</span>
                @endif
            </div>
        </div>
    </div>

    {{-- ONBOARDING & MODERATION --}}
    <div class="col-xl-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3 border-top-light border-2 {{ ($studiosEnAttente > 0 || $imagesEnAttente > 0) ? 'border-yellow-1' : '' }}">
            <h3 class="text-16 fw-500 mb-20 flex items-center">
                <i class="icon-shield text-yellow-1 mr-10 text-20"></i> Validation & Modération
            </h3>
            
            <div class="d-flex justify-between items-center py-10 border-bottom-light">
                <span class="text-15">Studios en attente de validation</span>
                @if($studiosEnAttente > 0)
                    <a href="{{ route('admin.studios.index') }}" class="badge bg-yellow-1 text-white px-15 py-5">{{ $studiosEnAttente }} à vérifier</a>
                @else
                    <span class="text-green-1 fw-500"><i class="icon-check"></i> Aucun</span>
                @endif
            </div>

            <div class="d-flex justify-between items-center py-10 border-bottom-light">
                <span class="text-15">Photos studios à modérer</span>
                @if($imagesEnAttente > 0)
                    <a href="{{ route('admin.moderation.index') }}" class="badge bg-yellow-1 text-white px-15 py-5">{{ $imagesEnAttente }} à valider</a>
                @else
                    <span class="text-green-1 fw-500"><i class="icon-check"></i> À jour</span>
                @endif
            </div>

            <div class="d-flex justify-between items-center py-10">
                <span class="text-15">Utilisateurs bannis (Sécurité)</span>
                <span class="text-red-1 fw-500">{{ $utilisateursBannis }} compte(s)</span>
            </div>
        </div>
    </div>
</div>

{{-- SECTION 3 : ACCES RAPIDES --}}
<div class="row y-gap-20 pt-40">
    <div class="col-12">
        <h2 class="text-18 fw-500 mb-10">Accès Rapides</h2>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="button -md -outline-blue-1 text-blue-1 px-30">
            <i class="icon-user mr-10"></i> Gérer les Utilisateurs
        </a>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.studios.index') }}" class="button -md -outline-purple-1 text-purple-1 px-30">
            <i class="icon-home mr-10"></i> Répertoire des Studios
        </a>
    </div>
</div>
@endsection

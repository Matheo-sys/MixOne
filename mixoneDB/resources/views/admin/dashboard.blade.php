@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Administration MixOne</h1>
        <div class="text-15 text-light-1">Vue d'ensemble et contrôle de la plateforme.</div>
    </div>
</div>

<div class="row y-gap-30">
    <!-- CA Total -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Volume d'affaires</div>
                    <div class="text-30 fw-600 mt-5">{{ number_format($totalVolume, 2) }} €</div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('media/img/dashboard/icons/1.svg') }}" alt="icon">
                </div>
            </div>
        </div>
    </div>

    <!-- Commissions -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Commissions</div>
                    <div class="text-30 fw-600 mt-5">{{ number_format($totalCommission, 2) }} €</div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('media/img/dashboard/icons/2.svg') }}" alt="icon">
                </div>
            </div>
        </div>
    </div>

    <!-- Artistes -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Artistes inscrits</div>
                    <div class="text-30 fw-600 mt-5">{{ $totalArtists }}</div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('media/img/dashboard/icons/3.svg') }}" alt="icon">
                </div>
            </div>
        </div>
    </div>

    <!-- Studios -->
    <div class="col-xl-3 col-md-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="row y-gap-20 justify-between items-center flex-nowrap">
                <div class="col-auto">
                    <div class="fw-500 text-light-1">Gestionnaires de Studios</div>
                    <div class="text-30 fw-600 mt-5">{{ $totalStudioUsers }}</div>
                    <div class="text-14 text-blue-1 mt-5">{{ $totalStudios }} studios actifs</div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('media/img/dashboard/icons/4.svg') }}" alt="icon">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row y-gap-30 pt-30">
    <div class="col-xl-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="d-flex justify-between items-center mb-20">
                <h2 class="text-18 fw-500">
                    <i class="icon-alert-triangle text-red-1 mr-10"></i>Litiges en attente
                </h2>
                @if($pendingDisputes > 0)
                    <div class="badge bg-red-1 text-white">{{ $pendingDisputes }} action(s) requise(s)</div>
                @endif
            </div>
            
            @if($pendingDisputes > 0)
                <p class="text-15 text-dark-1">Des sessions sont en litige. L'argent est bloqué. Vous devez trancher manuellement.</p>
                <!-- Ici viendra la liste des litiges -->
                <button class="button -md -red-1 text-white mt-20">Gérer les litiges</button>
            @else
                <div class="text-center py-40">
                    <div class="size-60 bg-green-1-05 text-green-1 rounded-full flex-center mx-auto mb-10 text-24">
                        <i class="icon-check"></i>
                    </div>
                    <p class="text-15 text-light-1">Aucun litige en cours. Tout va bien !</p>
                </div>
            @endif
        </div>
    </div>

    <div class="col-xl-6">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="d-flex justify-between items-center mb-20">
                <h2 class="text-18 fw-500">
                    <i class="icon-wallet text-blue-1 mr-10"></i>Demandes de virements
                </h2>
                @if($pendingPayouts > 0)
                    <div class="badge bg-blue-1 text-white">{{ $pendingPayouts }} virement(s) à faire</div>
                @endif
            </div>

            @if($pendingPayouts > 0)
                <p class="text-15 text-dark-1">Des studios demandent à retirer leurs gains. Vous devez envoyer l'argent via votre banque.</p>
                <!-- Ici viendra la liste des payouts -->
                <button class="button -md -blue-1 text-white mt-20">Gérer les virements</button>
            @else
                <div class="text-center py-40">
                    <div class="size-60 bg-green-1-05 text-green-1 rounded-full flex-center mx-auto mb-10 text-24">
                        <i class="icon-check"></i>
                    </div>
                    <p class="text-15 text-light-1">Aucun virement en attente.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@extends('layouts.backend')

@section('title', 'Paiement annulé | MixOne')

@section('content')
<section class="layout-pt-lg layout-pb-lg">
    <div class="container">
        <div class="row justify-center">
            <div class="col-xl-6 col-lg-8">
                <div class="px-50 py-50 rounded-16 bg-white shadow-4 text-center">
                    {{-- Icône annulation --}}
                    <div class="flex-center size-100 rounded-full mx-auto mb-30" style="background-color: #FFF3CD;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#856404" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="15" y1="9" x2="9" y2="15"></line>
                            <line x1="9" y1="9" x2="15" y2="15"></line>
                        </svg>
                    </div>

                    <h1 class="text-30 fw-600 text-dark-1 mb-10">Paiement annulé</h1>
                    <p class="text-15 text-light-1 mb-30">
                        Le paiement n'a pas été finalisé. Votre réservation est en attente — vous pouvez réessayer à tout moment.
                    </p>

                    @if($reservation)
                    <div class="px-30 py-20 rounded-8 bg-blue-1-05 mb-30 text-left">
                        <div class="d-flex justify-between items-center mb-10">
                            <span class="text-14 text-light-1">Studio</span>
                            <span class="text-14 fw-500 text-dark-1">{{ $reservation->studio->name }}</span>
                        </div>
                        <div class="d-flex justify-between items-center mb-10">
                            <span class="text-14 text-light-1">Date</span>
                            <span class="text-14 fw-500 text-dark-1">{{ $reservation->date->format('d/m/Y') }}</span>
                        </div>
                        <div class="d-flex justify-between items-center mb-10">
                            <span class="text-14 text-light-1">Montant</span>
                            <span class="text-14 fw-500 text-dark-1">{{ number_format($reservation->price, 2) }} €</span>
                        </div>
                    </div>

                    <div class="row x-gap-15 y-gap-15 justify-center">
                        <div class="col-auto">
                            <a href="{{ route('payment.checkout', $reservation) }}" class="button -md -blue-1 bg-blue-1 text-white">
                                <i class="icon-credit-card text-16 mr-10"></i>
                                Réessayer le paiement
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('studios.show', $reservation->studio) }}" class="button -md -outline-blue-1 text-blue-1">
                                Retour au studio
                            </a>
                        </div>
                    </div>
                    @else
                    <div class="row justify-center">
                        <div class="col-auto">
                            <a href="{{ route('home') }}" class="button -md -blue-1 bg-blue-1 text-white">
                                Retour à l'accueil
                            </a>
                        </div>
                    </div>
                    @endif

                    <p class="text-13 text-light-1 mt-20">
                        💡 Aucun montant n'a été débité de votre compte.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

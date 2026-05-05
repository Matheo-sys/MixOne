@extends('layouts.backend')

@section('title', 'Paiement réussi | MixOne')

@section('content')
<section class="layout-pt-lg layout-pb-lg">
    <div class="container">
        <div class="row justify-center">
            <div class="col-xl-6 col-lg-8">
                <div class="px-50 py-50 rounded-16 bg-white shadow-4 text-center">
                    {{-- Icône succès --}}
                    <div class="flex-center size-100 rounded-full bg-green-1 mx-auto mb-30">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>

                    <h1 class="text-30 fw-600 text-dark-1 mb-10">Paiement réussi !</h1>
                    <p class="text-15 text-light-1 mb-30">
                        Votre réservation a bien été confirmée et votre paiement a été traité avec succès.
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
                            <span class="text-14 text-light-1">Créneau</span>
                            <span class="text-14 fw-500 text-dark-1">{{ $reservation->time_slot }}</span>
                        </div>
                        <div class="d-flex justify-between items-center mb-10">
                            <span class="text-14 text-light-1">Durée</span>
                            <span class="text-14 fw-500 text-dark-1">{{ $reservation->number_of_hours }}h</span>
                        </div>
                        <div class="d-flex justify-between items-center border-top-light pt-10 mt-10">
                            <span class="text-16 fw-500 text-dark-1">Total payé</span>
                            <span class="text-18 fw-600 text-blue-1">{{ number_format($reservation->price, 2) }} €</span>
                        </div>
                    </div>
                    @endif

                    <div class="row x-gap-15 y-gap-15 justify-center">
                        <div class="col-auto">
                            <a href="{{ route('dashboard.artist.booking') }}" class="button -md -blue-1 bg-blue-1 text-white">
                                <i class="icon-calendar text-16 mr-10"></i>
                                Voir mes réservations
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('home') }}" class="button -md -outline-blue-1 text-blue-1">
                                Retour à l'accueil
                            </a>
                        </div>
                    </div>

                    <p class="text-13 text-light-1 mt-20">
                        📧 Un email de confirmation a été envoyé à votre adresse.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

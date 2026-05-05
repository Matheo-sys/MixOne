@extends('layouts.backend')

@section('title', 'Erreur interne | MixOne')

@section('content')
<section class="layout-pt-lg layout-pb-lg">
    <div class="container">
        <div class="row y-gap-30 justify-center text-center">
            <div class="col-lg-6">
                <div class="no-page">
                    <div class="no-page__title">50<span class="text-blue-1">0</span></div>
                    <h2 class="text-30 fw-600">Un petit bug technique...</h2>
                    <p class="mt-10">Nos ingénieurs du son sont sur le coup pour rétablir la situation. Veuillez nous excuser pour la gêne occasionnée.</p>

                    <div class="d-inline-block mt-40">
                        <a href="{{ route('home') }}" class="button -md -dark-1 bg-blue-1 text-white">
                            Retour à l'accueil <div class="icon-arrow-top-right ml-15"></div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

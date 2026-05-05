@extends('layouts.backend')

@section('title', 'Page non trouvée | MixOne')

@section('content')
<section class="layout-pt-lg layout-pb-lg">
    <div class="container">
        <div class="row y-gap-30 justify-between items-center">
            <div class="col-lg-6">
                <img src="{{ asset('media/img/general/404.svg') }}" alt="404" class="rounded-4">
            </div>

            <div class="col-lg-5">
                <div class="no-page">
                    <div class="no-page__title">40<span class="text-blue-1">4</span></div>
                    <h2 class="text-30 fw-600">Oups ! Cette page semble s'être perdue dans le mix.</h2>
                    <p class="mt-10">Désolé, mais la page que vous recherchez n'existe pas ou a été déplacée.</p>

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

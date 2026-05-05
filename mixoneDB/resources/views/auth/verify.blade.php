@extends('layouts.backend')

@section('content')
<section class="layout-pt-lg layout-pb-lg bg-blue-2">
    <div class="container">
        <div class="row justify-center">
            <div class="col-xl-6 col-lg-7 col-md-9">
                <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4 text-center">
                    <div class="size-60 bg-blue-1-05 text-blue-1 rounded-full flex-center mx-auto mb-20 text-24">
                        <i class="icon-email"></i>
                    </div>
                    <h1 class="text-22 fw-500 mb-10">Vérifiez votre adresse e-mail</h1>
                    
                    @if (session('resent'))
                        <div class="px-20 py-15 mb-20 bg-green-1-05 text-green-1 rounded-4 text-14">
                            Un nouveau lien de vérification a été envoyé à votre adresse e-mail.
                        </div>
                    @endif

                    <p class="text-15 text-dark-1 mb-20">
                        Avant de continuer et d'accéder à votre tableau de bord, veuillez vérifier votre boîte de réception (et vos spams) pour trouver le lien de vérification.
                    </p>

                    <p class="text-14 text-light-1 mb-20">Si vous n'avez pas reçu l'e-mail :</p>
                    
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="button -md bg-blue-1 text-white mx-auto">
                            Renvoyer l'e-mail de vérification
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

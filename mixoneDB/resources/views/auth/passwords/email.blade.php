@extends('layouts.backend')

@section('title', 'Mot de passe oublié | MixOne')

@section('content')
    <section class="layout-pt-lg layout-pb-lg bg-blue-2">
        <div class="container">
            <div class="row justify-center">
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                        <div class="row y-gap-20">
                            <div class="col-12">
                                <h1 class="text-22 fw-500">Réinitialisation du mot de passe</h1>
                                <p class="mt-10">Entrez votre adresse email pour recevoir un lien de réinitialisation.</p>
                            </div>

                            @if (session('status'))
                                <div class="col-12">
                                    <div class="d-flex items-center justify-between bg-success-1 pl-30 pr-20 py-30 rounded-8">
                                        <div class="text-success-2 lh-1 fw-500">{{ session('status') }}</div>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}" class="js-ajax-form">
                                @csrf
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        <label class="lh-1 text-14 text-light-1">Email</label>
                                    </div>
                                    @error('email')
                                        <div class="text-red-1 mt-5 text-14">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-20 d-flex justify-content-center">
                                    <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white mx-auto d-block" style="width: 100%; max-width: 530px;">
                                        Envoyer le lien<span class="icon-arrow-top-right ml-15"></span>
                                    </button>
                                </div>

                                <div class="col-12 mt-20 text-center">
                                    <a href="{{ route('login') }}" class="text-14 fw-500 text-blue-1 underline">Retour à la connexion</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

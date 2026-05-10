@extends('layouts.backend')

@section('title', 'Nouveau mot de passe | MixOne')

@section('content')
    <section class="layout-pt-lg layout-pb-lg bg-blue-2">
        <div class="container">
            <div class="row justify-center">
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                        <div class="row y-gap-20">
                            <div class="col-12">
                                <h1 class="text-22 fw-500">Choisir un nouveau mot de passe</h1>
                                <p class="mt-10">Veuillez entrer votre nouveau mot de passe ci-dessous.</p>
                            </div>

                            <form method="POST" action="{{ route('password.update') }}" class="js-ajax-form">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="email" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                        <label class="lh-1 text-14 text-light-1">Email</label>
                                    </div>
                                    @error('email')
                                        <div class="text-red-1 mt-5 text-14">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="form-input">
                                        <input type="password" name="password" required autocomplete="new-password">
                                        <label class="lh-1 text-14 text-light-1">Nouveau mot de passe</label>
                                    </div>
                                    @error('password')
                                        <div class="text-red-1 mt-5 text-14">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="form-input">
                                        <input type="password" name="password_confirmation" required autocomplete="new-password">
                                        <label class="lh-1 text-14 text-light-1">Confirmer le mot de passe</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-20 d-flex justify-content-center">
                                    <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white mx-auto d-block" style="width: 100%; max-width: 530px;">
                                        Réinitialiser le mot de passe<span class="icon-arrow-top-right ml-15"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

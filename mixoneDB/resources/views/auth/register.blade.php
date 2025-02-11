@extends('layouts.backend')




@section('content')
    <section class="layout-pt-lg layout-pb-lg bg-blue-2">
        <div class="container">
            <div class="row justify-center">
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                        <div class="row y-gap-20">
                            <div class="col-12">
                                <h1 class="text-22 fw-500">S'inscrire / Créer son compte</h1>
                                <p class="mt-10">Avez-vous un compte ? <a href="login.html" class="text-blue-1">Se connecter</a></p>
                            </div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <!-- Boutons pour choisir Artiste ou Studio -->
                                <div class="col-12">
                                    <label>
                                        Artiste
                                        <input type="radio" name="profile" value="artist">
                                    </label>

                                    <label>
                                        Studio
                                        <input type="radio" name="profile" value="studio">
                                    </label>

                                </div>

                                <!-- Section Artiste -->
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" required name="first_name">
                                        <label class="lh-1 text-14 text-light-1">Prénom</label>
                                    </div>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-input">
                                        <input type="text" required name="last_name">
                                        <label class="lh-1 text-14 text-light-1">Nom de famille</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-input">
                                        <input type="text" required name="email">
                                        <label class="lh-1 text-14 text-light-1">Email</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-input">
                                        <input type="password" required name="password">
                                        <label class="lh-1 text-14 text-light-1">Mot de passe</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="form-input">
                                        <input type="password" required name="password_confirmation">
                                        <label class="lh-1 text-14 text-light-1">Confirmer mot de passe</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="d-flex">
                                        <div class="form-checkbox mt-5">
                                            <input type="checkbox" name="gcu">
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 lh-15 text-light-1 ml-10">
                                            J'accepte les <a href="terms.html" class="text-blue-1">Conditions d'utilisation</a> et la <a href="terms.html" class="text-blue-1">Politique de confidentialité</a>.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <button type="submit" class="button py-20 w-100 -dark-1 bg-blue-1 text-white">
                                        S'inscrire<span class="icon-arrow-top-right ml-15"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>









<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                                <p class="mt-10">Avez-vous un compte ? <a href="login" class="text-blue-1">Se connecter</a></p>
                            </div>

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="col-12 d-flex gap-3 justify-content-center mt-3 mb-15">
                                    <label for="artist" class="profile-btn">
                                        <input type="radio" id="artist" name="profile" value="artist">
                                        Artiste
                                    </label>

                                    <label for="studio" class="profile-btn">
                                        <input type="radio" id="studio" name="profile" value="studio">
                                        Studio
                                    </label>
                                </div>


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

                                <div class="d-flex align-items-center">
                                    <div class="form-checkbox mt-5">
                                        <input type="checkbox" name="gcu" id="gcu" required>
                                        <div class="form-checkbox__mark">
                                            <div class="form-checkbox__icon icon-check"></div>
                                        </div>
                                    </div>

                                    <div class="text-15 lh-15 text-light-1 ml-10 mt-3 mb-3">
                                        J'accepte les <a href="{{ route('terms') }}" class="text-blue-1" target="_blank">Conditions d'utilisation</a> et la <a href="{{ route('terms') }}" class="text-blue-1" target="_blank">Politique de confidentialité</a>.
                                    </div>
                                </div>


                                @error('gcu')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror

                                <div class="col-12 mt-3 d-flex justify-content-center">
                                    <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white mx-auto d-block" style="width: 530px;">
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
@endsection

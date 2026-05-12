@extends('layouts.backend')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/zxcvbn@4.4.2/dist/zxcvbn.js"></script>

    <section class="layout-pt-lg layout-pb-lg bg-blue-2">
        <div class="container">
            <div class="row justify-center">
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                        <div class="row y-gap-20">
                            <div class="col-12">
                                <h1 class="text-22 fw-500">S'inscrire / Créer son compte</h1>
                                <p class="mt-10">Avez-vous un compte ? <a href="{{ route('login') }}" class="text-blue-1">Se connecter</a></p>

                            </div>

                            @if(session('error'))
                                <div class="col-12">
                                    <div class="d-flex items-center justify-between bg-red-1-05 border-1 rounded-4 px-20 py-15">
                                        <div class="text-red-1 fw-500">{{ session('error') }}</div>
                                    </div>
                                </div>
                            @endif

                            @if(session('success'))
                                <div class="col-12">
                                    <div class="d-flex items-center justify-between bg-green-1-05 border-1 rounded-4 px-20 py-15">
                                        <div class="text-green-1 fw-500">{{ session('success') }}</div>
                                    </div>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register') }}" class="js-ajax-form">
                                @csrf

                                <div class="col-12 mt-10 mb-20">
                                    <div class="profile-selection-container">
                                        <input type="radio" id="artist" name="profile" value="artist" class="hidden-radio" checked>
                                        <label for="artist" class="profile-btn">
                                            <i class="icon-mic"></i> Artiste
                                        </label>

                                        <input type="radio" id="studio" name="profile" value="studio" class="hidden-radio">
                                        <label for="studio" class="profile-btn">
                                            <i class="icon-headphones"></i> Studio
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="username" value="{{ old('username') }}" pattern="[a-zA-Z0-9._]+" maxlength="30" minlength="3">
                                        <label class="lh-1 text-14 text-light-1">Nom d'utilisateur (@username)</label>
                                    </div>
                                    <div class="text-12 text-light-1 mt-5">Lettres, chiffres, points et underscores uniquement. Laissez vide pour un username auto-généré.</div>
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="form-input">
                                        <input type="text" required name="first_name" value="{{ old('first_name') }}">
                                        <label class="lh-1 text-14 text-light-1">Prénom</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="form-input">
                                        <input type="text" required name="last_name" value="{{ old('last_name') }}">
                                        <label class="lh-1 text-14 text-light-1">Nom de famille</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="form-input">
                                        <input type="text" required name="email" value="{{ old('email') }}">
                                        <label class="lh-1 text-14 text-light-1">Email</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="form-input">
                                        <input type="password" required name="password">
                                        <label class="lh-1 text-14 text-light-1">Mot de passe</label>
                                    </div>
                                    <div id="password-strength-container" class="mt-10 d-none">
                                        <div class="progress h-4">
                                            <div id="strength-bar" class="progress-bar" role="progressbar" style="width: 0%"></div>
                                        </div>
                                        <div id="strength-text" class="text-12 mt-5"></div>
                                    </div>
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="form-input">
                                        <input type="password" required name="password_confirmation">
                                        <label class="lh-1 text-14 text-light-1">Confirmer mot de passe</label>
                                    </div>
                                </div>

                                <div class="col-12 mt-20">
                                    <div class="d-flex align-items-center">
                                        <div class="form-checkbox">
                                            <input type="checkbox" name="gcu" id="gcu" required>
                                            <div class="form-checkbox__mark">
                                                <div class="form-checkbox__icon icon-check"></div>
                                            </div>
                                        </div>

                                        <div class="text-15 lh-15 text-light-1 ml-10">
                                            J'accepte les <a href="{{ route('terms') }}" class="text-blue-1" target="_blank">Conditions d'utilisation</a>.
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-30 d-flex justify-content-center">
                                    <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white mx-auto d-block" style="width: 100%; max-width: 530px;">
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

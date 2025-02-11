
@extends('layouts.backend')
@section('content')
    <section class="layout-pt-lg layout-pb-lg bg-blue-2">
        <div class="container">
            <div class="row justify-center">
                <div class="col-xl-6 col-lg-7 col-md-9">
                    <div class="px-50 py-50 sm:px-20 sm:py-20 bg-white shadow-4 rounded-4">
                        <div class="row y-gap-20">
                            <div class="col-12">
                                <h1 class="text-22 fw-500">Content de vous revoir</h1>
                                <p class="mt-10">Toujours pas de compte ? <a href="{{ route('register') }}" class="text-blue-1">S'inscrire gratuitement</a></p>
                            </div>

                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="email" name="email" required class="@error('email') is-invalid @enderror" value="{{ old('email') }}">
                                        <label class="lh-1 text-14 text-light-1">Email</label>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="password" name="password" required class="@error('password') is-invalid @enderror">
                                        <label class="lh-1 text-14 text-light-1">Mot de passe</label>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-14 fw-500 text-blue-1 underline">Mot de passe oublié ?</a>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="button py-20 -dark-1 bg-blue-1 text-white">
                                        Se connecter <div class="icon-arrow-top-right ml-15"></div>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="row y-gap-20 pt-30">
                            <div class="col-12">
                                <div class="text-center">ou se connecter avec</div>

                                <button class="button col-12 -outline-blue-1 text-blue-1 py-15 rounded-8 mt-10">
                                    <i class="icon-facebook text-15 mr-10"></i>
                                    Facebook
                                </button>

                                <button class="button col-12 -outline-red-1 text-red-1 py-15 rounded-8 mt-15">
                                    <i class="icon-globe text-15 mr-10"></i>
                                    Google
                                </button>

                                <button class="button col-12 -outline-dark-2 text-dark-2 py-15 rounded-8 mt-15">
                                    <i class="icon-apple text-15 mr-10"></i>
                                    Apple
                                </button>
                            </div>

                            <div class="col-12">
                                <div class="text-center px-30">J'accepte les <a href="{{ url('/terms') }}" class="text-blue-1">Conditions d'utilisation</a> et la <a href="{{ url('/privacy') }}" class="text-blue-1">Politique de confidentialité</a>.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

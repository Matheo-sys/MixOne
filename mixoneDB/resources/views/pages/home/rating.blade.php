<section class="layout-pt-lg layout-pb-lg bg-blue-2">
    <div data-anim-wrap class="container">
        <div class="row y-gap-40 justify-between">
            <div data-anim-child="slide-up delay-1" class="col-xl-5 col-lg-6">
                <h2 class="text-30">Que disent nos clients<br class="d-none md:d-block"> sur nous ?</h2>
                <p class="mt-20">
                    @if($noteGlobale)
                        La satisfaction de nos artistes est notre priorité. Avec une note moyenne de {{ $noteGlobale }}/5, MixOne s'impose comme la référence pour vos sessions d'enregistrement.
                    @else
                        MixOne simplifie la vie des artistes et des studios. Soyez parmi les premiers à réserver et à partager votre expérience !
                    @endif
                </p>

                <div class="row y-gap-30 pt-60 lg:pt-40">
                    <div class="col-sm-5 col-6">
                        <div class="text-30 lh-15 fw-600">{{ $clientsSatisfaits > 0 ? $clientsSatisfaits : '0' }}</div>
                        <div class="text-light-1 lh-15">Réservations effectuées</div>
                    </div>

                    <div class="col-sm-5 col-6">
                        <div class="text-30 lh-15 fw-600">{{ $noteGlobale ?? 'N/A' }}</div>
                        <div class="text-light-1 lh-15">Note globale</div>

                        @if($noteGlobale)
                            <div class="d-flex x-gap-5 items-center pt-10">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="icon-star {{ $i <= round($noteGlobale) ? 'text-blue-1' : 'text-light-1' }} text-10"></div>
                                @endfor
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div data-anim-child="slide-up delay-2" class="col-lg-6">
                <div class="overflow-hidden js-testimonials-slider-3" data-scrollbar>
                    <div class="swiper-wrapper">

                        @forelse($avis as $unAvis)
                            <div class="swiper-slide">
                                <div class="row items-center x-gap-30 y-gap-20">
                                    <div class="col-auto">
                                        <div class="size-60 rounded-full overflow-hidden">
                                            <img src="{{ $unAvis->client->avatar ? storage_url($unAvis->client->avatar) : asset('media/img/misc/avatar-default.png') }}" alt="avatar" class="h-full w-full object-cover">
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <h5 class="text-16 fw-500">{{ $unAvis->client->first_name }} {{ substr($unAvis->client->last_name, 0, 1) }}.</h5>
                                        <div class="text-15 text-light-1 lh-15">Artiste chez {{ $unAvis->studio->name }}</div>
                                    </div>
                                </div>

                                <p class="text-18 fw-500 text-dark-1 mt-30 sm:mt-20">"{{ $unAvis->comment }}"</p>
                                <div class="d-flex x-gap-5 items-center pt-10">
                                    @for($i = 1; $i <= 5; $i++)
                                        <div class="icon-star {{ $i <= $unAvis->rating ? 'text-blue-1' : 'text-light-1' }} text-10"></div>
                                    @endfor
                                </div>
                            </div>
                        @empty
                            {{-- Avis par défaut si aucun avis réel (Demo mode discret) --}}
                            <div class="swiper-slide">
                                <div class="row items-center x-gap-30 y-gap-20">
                                    <div class="col-auto">
                                        <div class="size-60 rounded-full overflow-hidden">
                                            <img src="{{ asset('media/img/misc/avatar-default.png') }}" alt="image" class="h-full w-full object-cover">
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h5 class="text-16 fw-500">L'équipe MixOne</h5>
                                        <div class="text-15 text-light-1 lh-15">Bienvenue</div>
                                    </div>
                                </div>
                                <p class="text-18 fw-500 text-dark-1 mt-30 sm:mt-20">Aucun avis n'a encore été publié. Réservez votre première session pour partager votre expérience !</p>
                            </div>
                        @endforelse

                    </div>

                    @if($avis->count() > 0)
                        <div class="d-flex items-center mt-60 sm:mt-20 js-testimonials-slider-pag">
                            <div class="text-dark-1 fw-500 js-current">01</div>
                            <div class="slider-scrollbar bg-border ml-20 mr-20 w-max-300 js-scrollbar"></div>
                            <div class="text-dark-1 fw-500 js-all">{{ sprintf('%02d', $avis->count()) }}</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

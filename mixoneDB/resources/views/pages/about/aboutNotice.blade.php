<section class="section-bg layout-pt-lg layout-pb-lg">
    <div class="section-bg__item -mx-20 bg-light-2"></div>

    <div class="container">
        <div class="row justify-center text-center">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Entendu par des clients</h2>
                </div>
            </div>
        </div>

        <div class="overflow-hidden pt-80 js-section-slider" data-gap="30" data-slider-cols="xl-3 lg-3 md-2 sm-1 base-1">
            <div class="swiper-wrapper">

                @forelse($avis as $unAvis)
                    <div class="swiper-slide">
                        <div class="testimonials -type-1 bg-white rounded-4 pt-40 pb-30 px-40">
                            <div class="d-flex x-gap-5 items-center mb-20">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="icon-star {{ $i <= $unAvis->rating ? 'text-blue-1' : 'text-light-1' }} text-10"></div>
                                @endfor
                            </div>
                            <p class="testimonials__text lh-18 fw-500 text-dark-1">"{{ $unAvis->comment }}"</p>

                            <div class="pt-20 mt-28 border-top-light">
                                <div class="row x-gap-20 y-gap-20 items-center">
                                    <div class="col-auto">
                                        <div class="size-60 rounded-full overflow-hidden">
                                            <img class="h-full w-full object-cover" src="{{ $unAvis->client->avatar ? storage_url($unAvis->client->avatar) : asset('media/img/misc/avatar-default.png') }}" alt="avatar">
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 fw-500 lh-14">{{ $unAvis->client->first_name }} {{ substr($unAvis->client->last_name, 0, 1) }}.</div>
                                        <div class="text-14 lh-14 text-light-1 mt-5">Artiste</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="swiper-slide">
                        <div class="testimonials -type-1 bg-white rounded-4 pt-40 pb-30 px-40">
                            <p class="testimonials__text lh-18 fw-500 text-dark-1">Aucun avis n'a encore été déposé. Soyez le premier à partager votre expérience après votre session !</p>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
</section>
